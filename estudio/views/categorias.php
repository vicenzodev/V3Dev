<?php
    if(isset($_POST['categoria-action'])){
        $categoria = new Categoria();
        if($categoria->setCategoria($_POST['categoria'])){
            header('Location: '.PATH_ESTUDIO.'categorias');
            Controller::alert('sucesso','Categoria registrada com sucesso!');
        }else{
            Controller::alert('erro','Erro, tente novamente mais tarde.');
        }
    }

    $mt = Categoria::getAllCategoria();
    require_once('../app/Utils/toast.php');
?>
<section class="editar-categorias container">
    <div class="header-content">
        <div class="page-title">
            <h2>Categorias</h2>
            <p>Gerencia as categorias dos modelos.</p>
        </div>
        <button class="btn-add" onclick="openModal('modal')">
            <i class="ph ph-plus"></i> Nova Categoria
        </button>
    </div>

    <div class="crud-card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th style="text-align: right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($mt as $key => $value){?>
                    <tr>
                        <td><?php echo $value['id']?></td>
                        <td><?php echo $value['categoria']?></td>
                        <td class="actions" style="justify-content: flex-end;">
                            <button class="btn-icon btn-edit" title="Editar" onclick="openModal('modal')"><i class="ph ph-pencil-simple"></i></button>
                            <button class="btn-icon btn-delete" title="Excluir" onclick="openConfirmModal(<?php echo $value['id']?>,'catg')"><i class="ph ph-trash"></i></button>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div><!--crud-card-->

    <div class="modal-overlay" id="modalForm">
        <div class="modal">
            <div class="modal-header">
                <h3>Nova Categoria</h3>
                <button class="close-modal" onclick="closeModal('modal')">&times;</button>
            </div>
            
            <form method="post" id="categoria">
                <div class="form-group">
                    <label class="form-label">Categoria</label>
                    <input type="text" class="form-input" name="categoria" placeholder="Ex: PLA Hyper Speed, PETG">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('modal')">Cancelar</button>
                    <button type="submit" class="btn-save" name="categoria-action">Salvar Registro</button>
                </div>
            </form>
        </div>
    </div><!--modal-overlay-->
</section><!--editar-modelos container-->
<script src="js/modal.js"></script>