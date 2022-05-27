<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            @page { size: auto;  margin: 0mm; }
        </style>
    </head>
<body>

<div class="container">
    <p>{{ $card_prop->card->cardType->name }}</p>
    <p>{{ $card_prop->created_at->format('d M Y') }}</p>

<button class="btn btn-primary" onclick="printForm()" id="printbtn">Print Form</button>
</div>




<script type="text/javascript">
    function printForm() {
        document.getElementById('printbtn').style.display="none";
        window.print();
    }
</script>
</body>
</html>
