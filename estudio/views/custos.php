<?php
    if(isset($_POST['material-action'])){
        $material = new Material();
        if($material->setMaterial(
            $_POST['nome'],
            $_POST['marca'],
            $_POST['cor'],
            (float) $_POST['custo'],
            (float) $_POST['peso'],
            (float) $_POST['disponivel'])){
            header('Location: '.PATH_ESTUDIO.'custos');
            Controller::alert('sucesso','Material registrado com sucesso!');
        }else{
            Controller::alert('erro','Erro, tente novamente mais tarde.');
        }
    }

    if(isset($_POST['custo-action'])){
        $custo = new Custo();
        if($custo->setCusto(
            $_POST['nome'],
            (float) $_POST['custo'],
            (int) $_POST['quantidade'],
            $_POST['data-inicio'],
            $_POST['data-final'],
            1)){
            header('Location: '.PATH_ESTUDIO.'custos');
            Controller::alert('sucesso','Custo registrado com sucesso!');
        }else{
            Controller::alert('erro','Erro, tente novamente mais tarde.');
        }
    }

    $mt = Material::getAllMaterial();
    $ct = Custo::getAllCusto();
    require_once('../app/Utils/toast.php');
?>
<section class="editar-modelos container">
    <div class="header-content">
        <div class="page-title">
            <h2>Materiais</h2>
            <p>Gerencie os filamentos.</p>
        </div>
        <button class="btn-add" onclick="openModal('material')">
            <i class="ph ph-plus"></i> Novo Material
        </button>
    </div>

    <div class="crud-card">
        <table>
            <thead>
                <tr>
                    <th>Nome do Material</th>
                    <th>Marca</th>
                    <th>Cor</th>
                    <th>Custo</th>
                    <th>Peso</th>
                    <th style="text-align: right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($mt as $key => $value){?>
                    <tr>
                        <td><strong><?php echo $value['nome']?></strong></td>
                        <td><?php echo $value['marca']?></td>
                        <td><?php echo $value['cor']?></td>
                        <td>R$ <?php echo $value['custo']?></td>
                        <td><b><?php echo $value['disponivel']?>g</b> / <?php echo $value['peso']?>g</td>
                        <td class="actions" style="justify-content: flex-end;">
                            <button class="btn-icon btn-edit" title="Editar" onclick="openModal('material')"><i class="ph ph-pencil-simple"></i></button>
                            <button class="btn-icon btn-delete" title="Excluir" onclick="openConfirmModal(<?php echo $value['id']?>,'mt')"><i class="ph ph-trash"></i></button>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div><!--crud-card-->

    <div class="header-content">
        <div class="page-title">
            <h2>Outros Custos</h2>
            <p>Gerencie os demais custos.</p>
        </div>
        <button class="btn-add" onclick="openModal('custo')">
            <i class="ph ph-plus"></i> Novo Custo
        </button>
    </div>

     <div class="crud-card">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Custo Unit.</th>
                    <th>Quantidade</th>
                    <th>Data de início</th>
                    <th>Data final</th>
                    <th>Status</th>
                    <th style="text-align: right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ct as $key => $value){?>
                    <tr>
                        <td><strong><?php echo $value['nome']?></strong></td>
                        <td>R$ <?php echo $value['custo']?></td>
                        <td><?php if($value['quantidade'] !=-1)echo $value['quantidade'];else echo '<span class="status-badge status-mensal">mensal</span>'?></td>
                        <th><?php echo $value['data_inicio']?></th>
                        <th><?php echo $value['data_final']?></th>
                        <td><span class="status-badge <?php if($value['ativo'] == 1) echo 'status-active'; else echo 'status-inactive';?>">
                            <?php if($value['ativo'] == 1) echo 'ativo'; else echo 'inativo';?>
                        </span></td>
                        <td class="actions" style="justify-content: flex-end;">
                            <button class="btn-icon btn-edit" title="Editar" onclick="openModal('material')"><i class="ph ph-pencil-simple"></i></button>
                            <button class="btn-icon btn-delete" title="Excluir" onclick="openConfirmModal(<?php echo $value['id']?>,'ct')"><i class="ph ph-trash"></i></button>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div><!--crud-card-->

    <div class="modal-overlay" id="modalFormMaterial">
        <div class="modal">
            <div class="modal-header">
                <h3>Novo Material</h3>
                <button class="close-modal" onclick="closeModal('material')">&times;</button>
            </div>
            
            <form method="post" id="material">
                <div class="form-group">
                    <label class="form-label">Nome do Item</label>
                    <input type="text" class="form-input" name="nome" placeholder="Ex: PLA Hyper Speed, PETG">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Marca</label>
                        <input type="text" class="form-input" name="marca" placeholder="Ex: Voolt3D, F3D">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cor</label>
                        <input type="text" class="form-input" name="cor" placeholder="verde, vermelho, etc...">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Peso</label>
                        <input type="number" step="0.01" class="form-input" name="peso" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Disponível</label>
                        <input type="number" step="0.01" class="form-input" name="disponivel" placeholder="0.00">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Custo Total (R$)</label>
                    <input type="number" step="0.01" class="form-input" name="custo" placeholder="0.00">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('material')">Cancelar</button>
                    <button type="submit" class="btn-save" name="material-action">Salvar Registro</button>
                </div>
            </form>
        </div>
    </div><!--modal-overlay-->

    <div class="modal-overlay" id="modalFormCusto">
        <div class="modal">
            <div class="modal-header">
                <h3>Novo Custo</h3>
                <button class="close-modal" onclick="closeModal('custo')">&times;</button>
            </div>
            
            <form method="post" id="custo">
                <div class="form-group">
                    <label class="form-label">Nome do Item</label>
                    <input type="text" class="form-input" name="nome" placeholder="Ex: Energia, Embalagem, ...">
                </div>

                <div class="form-row">
                   <div class="form-group">
                        <label class="form-label">Custo (R$)</label>
                        <input type="number" step="0.01" class="form-input" name="custo" placeholder="R$ 0,00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Quantidade (Unidade)</label>
                        <input type="number" class="form-input" name="quantidade" placeholder="1, 2, 3, ...">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Data de início</label>
                        <input type="date" class="form-input" name="data-inicio">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Data final</label>
                        <input type="date" class="form-input" name="data-final">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('custo')">Cancelar</button>
                    <button type="submit" class="btn-save" name="custo-action">Salvar Registro</button>
                </div>
            </form>
        </div>
    </div><!--modal-overlay-->
</section><!--editar-modelos container-->
<script src="js/modal.js"></script>