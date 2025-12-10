{{-- resources/views/admin/reports/preview.blade.php --}}
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Report Preview</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        /* small wrapper styles so preview looks good */
        body {
            font-family: Arial, sans-serif;
            margin: 20px auto !important;
            background: #fff;
            color: #222;
            width: 80% !important;
        }

        .controls {
            margin-bottom: 18px;
        }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            background: #5d1229;
            color: #fff;
            border-radius: 20px;
            text-decoration: none;
            border: none;
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
        }
    </style>
</head>

<body>
    <div class="controls">
        {{-- Download link: include filters as query params --}}
        <form id="downloadForm" action="{{ route('reports.download') }}" method="GET" style="display:inline;">
            @foreach ($filters as $key => $value)
                @if (is_array($value))
                    @foreach ($value as $v)
                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach

            <button type="submit" class="btn">Download PDF</button>
        </form>

        {{-- Back button to close preview (or link back) --}}
        <a href="javascript:window.close();" class="btn btn-secondary" style="margin-left:10px;">Close Preview</a>
    </div>

    <hr>

    {{-- Report HTML rendered here --}}
    <div class="report-html">
        {!! $html !!}
    </div>
</body>

</html>
