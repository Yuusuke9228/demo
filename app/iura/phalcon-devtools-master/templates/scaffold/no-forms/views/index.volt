<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("$plural$/index", "戻る") }}</li>
            <li class="next">{{ link_to("$plural$/new", "新規 ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>検索結果</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
    $headerColumns$
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for $singularVar$ in page.items %}
            <tr>
    $rowColumns$
                <td>{{ link_to("$plural$/edit/"~$singularVar$.$pk$, "修正") }}</td>
                <td>{{ link_to("$plural$/delete/"~$singularVar$.$pk$, "削除") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("$plural$/search", "<<最初") }}</li>
                <li>{{ link_to("$plural$/search?page="~page.before, "<前へ") }}</li>
                <li>{{ link_to("$plural$/search?page="~page.next, "次へ>") }}</li>
                <li>{{ link_to("$plural$/search?page="~page.last, "最後>>") }}</li>
            </ul>
        </nav>
    </div>
</div>
