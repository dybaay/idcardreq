<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\CardProperty;
use App\Traits\DocumentType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class CardWizard extends Component
{
    use WithFileUploads, DocumentType;
    public int $step;
    public $card, $faculty, $department, $documents, $card_documents, $card_code;

    public function mount()
    {
        $this->step = 0;
        $this->department = user_department_id();
        $this->faculty = user_faculty_id();
        $this->card_documents = [];
    }

    public function updatedCard()
    {
        $this->card_documents = get_card_data_documents($this->card);
    }

    protected array $messages = [
        'card.required' => 'Card type is required',
        'card.exists' => 'The card type is not valid.',
        'faculty.required' => 'Faculty is required',
        'faculty.exists' => 'The faculty is not valid.',
        'department.required' => 'Department is required',
        'department.exists' => 'The department type is not valid.'
    ];

    public function checks_for_step_one()
    {
        $rules = [
            'card' => 'required|exists:card_types,id',
            'faculty' => 'required|exists:faculties,id',
            'department' => 'required|exists:departments,id'
        ];
        try {
            $this->validate($rules);
        }
        catch (\Exception $e){
            $this->step--;
            $this->validate($rules);
        }
    }

    public function checks_for_step_two()
    {
        $rules = [];
        $messages = [];
        foreach ($this->card_documents as $docs){
            $rules['card_document_'.$docs->id] = 'required|image|max:2048';
            $messages['card_document_'.$docs->id.'.required'] = 'All document is required';
            $messages['card_document_'.$docs->id.'.image'] = 'All document must be an image';
            $messages['card_document_'.$docs->id.'.uploaded'] = 'All document must not be greater than 2MB';
        }

        try {
            $this->validate($rules, $messages);
        }
        catch (\Exception $e){
            $this->step--;
            $this->validate($rules, $messages);
        }
    }

    public function previous()
    {
        $this->step--;
    }

    public function next()
    {
        $this->step++;

        if ($this->step == 1){
            $this->checks_for_step_one();
        }

        if ($this->step == 2 && count($this->card_documents) > 0){
            $this->checks_for_step_two();
        }
    }

    public function complete()
    {
        $this->submit_form();
    }

    public function home()
    {
       return redirect()->to(route('view-card', $this->card_code));
    }

    public function back()
    {
        $this->step = 2;
    }

    public function submit_form()
    {
        sleep(2);
        try {
            DB::transaction(function () {

                $today = Carbon::today();
                $card_config = config('card');

                $card = Card::create([
                    'user_id' => auth()->id(),
                    'card_type_id' => $this->card,
                    'faculty_id' => $this->faculty,
                    'department_id' => $this->department
                ]);

                $card->cardProperty()->create([
                    'identity_no' => generate_card_number(),
                    'status' => CardProperty::STATUS['Pending'],
                    'printed_at' => $today->copy()->addDays($card_config['printed_at']),
                    'expire_at' => $today->copy()->addDays($card_config['expire_at']),
                ]);

                foreach ($this->card_documents as $doc){

                    $name = 'card_document_'.$doc->id;
                    $card->cardDocuments()->create([
                        'name' => get_user_first_name().'_'.$doc->name.'_'.Carbon::now()->toDateTimeString(),
                        'file' => $this->$name->store('documents'),
                        'card_document_type_id' => $doc->id,
                        'card_type_id' => $doc->card_type_id
                    ]);

                }

                $this->card_code = $card->cardProperty->identity_no;

            });

            $this->step = -1;
        }
        catch (\Exception $e){
            Log::error('Card Request Error: '.$e->getMessage());
            $this->step = -2;
        }
    }


    public function render()
    {
        return view('livewire.card-wizard');
    }
}
