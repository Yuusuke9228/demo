<div id="header">
  <nav class="navbar navbar-fixed-top navbar-inverse" style="background: url(<?= $this->url->get('img1/simomura_2.png') ?>);">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?= $this->tag->linkTo(['navigators', '隼販売', 'class' => 'navbar-brand', 'title' => 'ナビゲータ', 'target' => '_blank']) ?> <!--<a class="navbar-brand" href="#">ERPh</a> -->
        </div>
        <?= $this->elements->getMenu() ?>
    </div>
  </nav>
  <div  style="padding:30px 0 0 0"> </div>
</div>

<div class="container-fulid" style="margin:0 20px 0 20px;"><div class="container"></div>
    <?= $this->flash->output() ?>
    <?= $this->getContent() ?>
    <div id="footer">
      <hr>
      <footer>
        <p>&copy; SHIMOMURA SOFINA Group 2017</p>
      </footer>
    </div>
</div>
