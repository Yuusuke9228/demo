
<?= $this->getContent() ?>

<div class="row">

    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="page-header">
            <h1 align="center"><span style='color:red;'>隼<span style='font-size:12px;'> [ はやぶさ ] </span></span><span style='color:blue;'>販売管理</span></h1>
            <h3 align="center">Welcome! to  <span style='color:blue;'>DEMO</span></h3>
        </div>
        <?= $this->tag->form(['session/start', 'role' => 'form']) ?>
            <fieldset>
                <div class="form-group">
                    <label for="cd">ユーザーコード</label>
                    <div class="controls">
                        <?= $this->tag->textField(['cd', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <div class="controls">
                        <?= $this->tag->passwordField(['password', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                            <?= $this->tag->checkField(['hozon']) ?> <label for="password">ユーザーコードを保存する</label>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <?= $this->tag->submitButton(['ログイン*12', 'class' => 'btn btn-primary btn-large', 'id' => 'F12']) ?>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="col-md-3">
    </div>
</div>