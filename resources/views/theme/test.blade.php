<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor Signature</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body class="p-4">

    <div class="card">
        <div class="card-header">Doctor Signature</div>
        <div class="card-body text-center">
            <canvas id="signatureCanvas" width="400" height="200" style="border: 1px solid #ccc;"></canvas>
            <br>
            <button type="button" class="btn btn-secondary mt-2" id="clearBtn">Clear</button>
            <form method="POST" action="#">
                @csrf
                <input type="hidden" name="signature" id="signatureInput">
                <button type="submit" class="btn btn-primary mt-2">Save Signature</button>
            </form>
        </div>
    </div>

    {{-- Load Signature Pad FIRST --}}
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script>
        const canvas = document.getElementById('signatureCanvas');
        const signaturePad = new SignaturePad(canvas);

        document.getElementById('clearBtn').addEventListener('click', function() {
            signaturePad.clear();
            document.getElementById('signatureInput').value = '';
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            if (!signaturePad.isEmpty()) {
                document.getElementById('signatureInput').value = signaturePad.toDataURL();
            }
        });
    </script>

</body>

</html>
