<!-- resources/views/calculate.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Courier Cost Calculator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: beige;
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
        }
        .container {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: all 0.5s ease;
        }
        .card {
            width: 100%;
            max-width: 600px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }
        .card-header {
            background-color: #343a40;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            padding: 2rem;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        #result {
            margin-top: 30px;
            opacity: 0;
            transition: opacity 0.5s ease;
            display: none;
        }
        .half-width {
            width: 48% !important;
        }
        #result-card {
            width: 135%;
            margin-left: 30px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card" id="form-card">
            <div class="card-header text-center">
                <h2>Courier Cost Calculator</h2>
            </div>
            <div class="card-body">
                <form id="calculator-form">
                    <div class="mb-3">
                        <label for="cost_per_mile" class="form-label">Cost per Mile (£):</label>
                        <input type="number" step="0.01" class="form-control" id="cost_per_mile" name="cost_per_mile" required>
                        <div id="cost-per-mile-error" class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="distances" class="form-label">Distances (miles):</label>
                        <input type="text" class="form-control" id="distances" name="distances" placeholder="e.g., 55,13,22" required>
                        <small class="form-text text-muted">Enter distances separated by commas.</small>
                        <div id="distances-error" class="error-message"></div>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="is_two_person_job" name="is_two_person_job">
                        <label class="form-check-label" for="is_two_person_job">Two Person Job</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Calculate</button>
                </form>
            </div>
        </div>
        <div id="result">
            <div class="card" id="result-card">
                <div class="card-body">
                    <h4 class="card-title">Quote Details</h4>
                    <p class="card-text">Number of Drop-offs: <span id="num-drop-offs"></span></p>
                    <p class="card-text">Total Distance: <span id="total-distance"></span> miles</p>
                    <p class="card-text">Cost per Mile: £<span id="cost-per-mile"></span></p>
                    <p class="card-text">Extra Person Price: £<span id="extra-person-price"></span></p>
                    <p class="card-text">Total Price: £<span id="total-price"></span></p>
                    <p class="card-text">Two Person Job: <span id="is-two-person-job"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#calculator-form').on('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            $('.error-message').text('');

            var formData = {
                cost_per_mile: $('#cost_per_mile').val(),
                distances: $('#distances').val().split(',').map(Number),
                is_two_person_job: $('#is_two_person_job').is(':checked')
            };

            $.ajax({
                url: '{{ route("api.get-quote") }}',
                method: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code === 200) {
                        $('#form-card').addClass('half-width');
                        $('#result').css('opacity', 1);
                        $('#result').css('display', "block");
                        $('#result-card').css('opacity', 1);

                        $('#num-drop-offs').text(response.data.quote_data.num_drop_offs);
                        $('#total-distance').text(response.data.quote_data.total_distance);
                        $('#cost-per-mile').text(response.data.quote_data.cost_per_mile);
                        $('#extra-person-price').text(response.data.quote_data.extra_person_price);
                        $('#total-price').text(response.data.quote_data.total_price);
                        $('#is-two-person-job').text(response.data.quote_data.is_two_person_job ? 'Yes' : 'No');
                    } else {
                        $('#result').html('<div class="alert alert-danger">Error: ' + response.message + '</div>');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.data;
                        if (errors.cost_per_mile) {
                            $('#cost-per-mile-error').text(errors.cost_per_mile.join(', '));
                        }
                        if (errors.distances) {
                            $('#distances-error').text(errors.distances.join(', '));
                        }
                    } else {
                        $('#result').html('<div class="alert alert-danger">An error occurred while calculating the quote.</div>');
                    }
                }
            });
        });
    });
    </script>
    </body>
    </html>
