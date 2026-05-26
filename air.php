<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengecekan Kualitas Air</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin: auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            cursor: pointer;
        }
        .result {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
// Function to check if water quality is safe based on input values
function checkWaterQuality($values) {
    $result = 1; // Default result is safe

    // Rule for ammonia
    if ($values['aluminium'] > 2.8) {
        $result = 0; // Water is unsafe
    }
    // Rule for kloramin
    elseif ($values['barium'] > 2) {
        $result = 0; // Water is unsafe
    }
    // Rule for bacteria
    elseif ($values['chloramine'] > 4) {
        $result = 0; // Water is unsafe
    }
    // Rule for virus
    elseif ($values['flouride'] > 1.5) {
        $result = 0; // Water is unsafe
    }
    // Rule for timbal
    elseif ($values['nitrates'] > 10) {
        $result = 0; // Water is unsafe
    }
    // Rule for merkuri
    elseif ($values['radium'] > 5) {
        $result = 0; // Water is unsafe
    }

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputValues = [
        'aluminium' => $_POST['aluminium'],
        'barium' => $_POST['barium'],
        'chloramine' => $_POST['chloramine'],
        'flouride' => $_POST['flouride'],
        'nitrates' => $_POST['nitrates'],
        'radium' => $_POST['radium'],
    ];

    $result = checkWaterQuality($inputValues);
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table>
        <tr>
            <th>Chemicals</th>
            <th>Qualifications (ppm)</th>
        </tr>
        <tr>
            <td>Aluminium</td>
            <td><input type="number" name="aluminium" step="0.01" required></td>
        </tr>
        <tr>
            <td>Barium</td>
            <td><input type="number" name="barium" step="0.01" required></td>
        </tr>
        <tr>
            <td>Chloramine</td>
            <td><input type="number" name="chloramine" step="0.01" required></td>
        </tr>
        <tr>
            <td>Flouride</td>
            <td><input type="number" name="flouride" step="0.01" required></td>
        </tr>
        <tr>
            <td>Nitrates</td>
            <td><input type="number" name="nitrates" step="0.01" required></td>
        </tr>
        <tr>
            <td>Radium</td>
            <td><input type="number" name="radium" step="0.01" required></td>
        </tr>
        <!-- Add other rows for chemical substances -->
    </table>
    <br>
    <input type="submit" value="Check Kualitas Air">
</form>

<div class="result">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($result == 1) {
            echo 'Air Aman';
        } else {
            echo 'Air Berbahaya';
        }
    }
    ?>
</div>

</body>
</html>
