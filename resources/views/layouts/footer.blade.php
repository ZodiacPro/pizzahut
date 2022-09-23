<script src="https://unpkg.com/bowser@2.4.0/es5.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<footer class="footer">
    <div class="container-fluid">
        <ul class="nav">
            <li class="nav-item">
                <a href="https://github.com/zodiacpro" target="blank" class="nav-link">
                    {{-- {{ __('ZodiacPro') }} --}}
                </a>
            </li>
        </ul>
        <div class="copyright">
            {{-- &copy; {{ now()->year }} {{ __('made with') }} <i class="tim-icons icon-heart-2"></i> {{ __('by') }}
            <a href="https://github.com/zodiacpro" target="_blank">{{ __('ZodiacPro') }}</a> --}}
            <p id="footnote"></p>
        </div>
    </div>
</footer>
<script>
var result = bowser.getParser(window.navigator.userAgent);
console.log(result);
$('#footnote').html("You are using " + result.parsedResult.browser.name +
               " v" + result.parsedResult.browser.version + 
               " on " + result.parsedResult.os.name);
</script>