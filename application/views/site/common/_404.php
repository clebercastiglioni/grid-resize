<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php $this->load->view('site/common/_head'); ?>
    </head>
    <body>
        <?php $this->load->view('site/common/_header'); ?>

        <section id="_404" class="row-no-margin">       
            <div class="row dsptable pdtop50 pdbot50">
                <h1>Ops, algo deu errado...</h1>

                <h3>            
                    A página que você está tentando acessar está com o link quebrado ou não está mais disponível.<br/>
                </h3>           

                <a href="<?php echo base_url() ?>" class="btn">Voltar para a home</a>                
            </div>
        </section>

        <?php $this->load->view('site/common/_footer'); ?>
    </body>
</html>