@extends('agent-dashboard.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card">
        <div class="list-header">

            <div class="container-fluid py-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 col-lg-6">
                        <h4 class="mb-0">Buyer NDA</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-data">
            <div class="copyable-url mb-5">
                <input type="text" value="{{ $url }}" readonly class="form-control copy-input">
                <button class="copy-button" onclick="copyToClipboard()">Copy</button>
            </div>
        </div>

    </div>
</div>
<style>
    .copyable-url {
        position: relative;
        width: 100%;
    }

    .copy-input {
        width: 100%;
        padding-right: 80px;
        /* Space for the button */
    }

    .copy-button {
        position: absolute;
        right: 10px;
        /* Distance from the right side */
        top: 50%;
        transform: translateY(-50%);
        /* Center vertically */
        padding: 5px 10px;
        background-color: #5a102a;
        color: white;
        border: none;
        cursor: pointer;
    }

    .copy-button:hover {
        background-color: #5a102a;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function copyToClipboard() {
        var inputElement = document.querySelector('.copy-input');
        inputElement.select();
        document.execCommand('copy');
    }
</script>
@endsection