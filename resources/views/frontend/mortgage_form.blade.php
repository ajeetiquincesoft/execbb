<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mortgage Calculator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-box {
            background-color: #FFFFFF;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            border-radius: 8px;
        }

        .main-heading {
            font-size: 24px;
            font-weight: bold;
            font-family: Urbanist;
            margin-bottom: 20px;
            color: #000;
            border-bottom: 1px solid #B3B3B3;
            padding-bottom: 20px;
        }

        .sub-heading {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin-bottom: 20px;
        }

        .about_EBB {
            text-align: center;
        }

        .mortgage,
        .mortgage_result {
            width: 80%;
            margin: 0 auto;
        }

        .btn-reset {
            background-color: #7F2149;
            border-color: #7F2149;
            color: #fff;
        }

        .btn-primary {
            background-color: #7F2149;
            border-color: #7F2149;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content-box">
            <div class="row">
                <div class="about_EBB">
                    <h5 class="main-heading">Mortgage Calculator</h5>
                    <h6 class="sub-heading">Enter Your Details & Click the Calculate Button</h6>
                </div>
            </div>

            <div class="row">
                <!-- Main Content -->
                <div class="col-md-12 main-head">
                    <form action="{{ route('calculate.mortgage') }}" method="POST" class="mortgage">
                        @csrf
                        <div class="mb-3">
                            <label for="loan_amount" class="form-label">Loan Amount ($)</label>
                            <input type="number" class="form-control" id="loan_amount" name="loan_amount"
                                value="{{ old('loan_amount') }}" required>
                            @error('loan_amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="interest_rate" class="form-label">Annual Interest Rate (%)</label>
                            <input type="number" step="0.01" class="form-control" id="interest_rate"
                                name="interest_rate" value="{{ old('interest_rate') }}" required>
                            @error('interest_rate')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="loan_term" class="form-label">Loan Term (Months)</label>
                            <input type="number" class="form-control" id="loan_term" name="loan_term"
                                value="{{ old('loan_term') }}" required>
                            @error('loan_term')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Calculate</button>
                        <button type="button" class="btn btn-reset" id="resetForm">Reset</button>
                    </form>

                    @if (isset($monthlyPayment))
                        <div class="mt-4 mortgage_result">
                            <h3>Mortgage Calculation Results:</h3>
                            <div class="mb-3">
                                <label for="monthly_payment" class="form-label">Monthly Payment ($)</label>
                                <input type="text" class="form-control" id="monthly_payment" name="monthly_payment"
                                    value="{{ $monthlyPayment }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="total_interest" class="form-label">Total Interest ($)</label>
                                <input type="text" class="form-control" id="total_interest" name="total_interest"
                                    value="{{ $totalInterest }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="total_amount" class="form-label">Total Amount Paid ($)</label>
                                <input type="text" class="form-control" id="total_amount" name="total_amount"
                                    value="{{ $totalAmount }}" readonly>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Reset Button
            $('#resetForm').on('click', function() {
                window.location.href = "{{ route('calculate.mortgage.form') }}"; // Reload the form
            });
        });
    </script>
</body>

</html>
