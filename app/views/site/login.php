<?php $this->view("site/include/header"); ?>

    <div class="login-register-area pt-115 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a href="#">
                                <h4>Acessar Sistema</h4>
                            </a>
                        </div>

                        <div class="login-form-container">
                            <div class="login-register-form">
                                <form id="formLogin">
                                    <label>Seu e-mail</label>
                                    <input type="email" name="email" placeholder="exemplo@email.com" required />

                                    <label>Sua senha</label>
                                    <input type="password" name="senha" placeholder="********" required />
                                    <div class="button-box">
                                        <button type="submit">Acessar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->view("site/include/footer"); ?>