<div class="page-header">
    <h1>
        検索 $nplural$
    </h1>
    <p>
        {{ link_to("$plural$/new", "新規 $nplural$") }}
    </p>
</div>

{{ content() }}

{{ form("$plural$/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

$captureFields$
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('実行', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
