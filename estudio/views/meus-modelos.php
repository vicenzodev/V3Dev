<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $modelo = new Modelo(
            $_POST['produto'],
            (float)$_POST['tempo'],
            (float)$_POST['qmu'],     
            (float)$_POST['custo'],
            (float)$_POST['markup'],
            (float)$_POST['preco'],
            $arquivo = Controller::uploadArquivo($_FILES['arquivo']),
            $img = Controller::uploadArquivo($_FILES['img']),
            (int)$_POST['categoria_id'],
            (int)$_POST['material_id']
        );

        if ($modelo->setModelo()) {
            header('Location: '.PATH_ESTUDIO.'meus-modelos');
            Controller::alert('sucesso','Modelo registrado com sucesso!');
        } else {
            Controller::alert('erro',"Erro, tente novamente mais tarde.");
        }
    }

    $categorias = Categoria::getAllCategoria();
    $materiais = Material::getAllMaterial();
    $modelos = Modelo::getAllModelo();
?>
<section class="container">
    <div class="controls-section">
        <div class="page-header">
            <h1>Catálogo de Modelos</h1>
            <p>Gerencie seus arquivos STL, configure preços de impressão e organize seu portfólio técnico.</p>
        </div>

        <div class="toolbar">
            <div class="filter-group">
                <button class="filter-btn active">Todos</button>
                <?php foreach($categorias as $key => $value){?>
                    <button class="filter-btn"><?php echo $value['categoria']?></button>
                <?php }?>
            </div>

            <div class="search-wrapper">
                <i class="ph ph-magnifying-glass search-icon"></i>
                <input type="text" class="search-input" placeholder="Buscar por nome, material...">
            </div>
            <button class="btn-add" onclick="openModal('modelo')">
                <i class="ph ph-plus"></i> Novo Modelo
            </button>
        </div>
    </div>
    <div class="catalog-grid">
        <article class="model-card">
            <div class="card-image">
                <span class="category-badge">Decor</span>
                <img src="https://images.unsplash.com/photo-1513161455079-7dc1de15ef3e?q=80&w=400&auto=format&fit=crop" alt="Vaso">
            </div>
            <div class="card-content">
                <h3 class="card-title">Vaso Geométrico Low-Poly</h3>
                <p class="card-desc">Design moderno otimizado para 'Vase Mode' (espiralizado).</p>
                
                <div class="tech-specs">
                    <div class="spec-item"><i class="ph ph-clock"></i> 3h</div>
                    <div class="spec-item"><i class="ph ph-barbell"></i> 80g</div>
                    <div class="spec-item"><i class="ph ph-drop"></i> PETG</div>
                </div>
            </div>
            <div class="card-footer">
                <span class="price">R$ 45,00</span>
                <div style="display: flex; gap: 8px;">
                    <button class="btn-action" title="Editar"><i class="ph ph-pencil-simple"></i></button>
                    <button class="btn-main-action"><i class="ph ph-printer"></i> Imprimir</button>
                </div>
            </div>
        </article>
        <?php foreach($modelos as $key => $value){?>
            <article class="model-card">
                <div class="card-image">
                    <span class="category-badge"><?php echo $categorias[$value['categoria_id']-1]['categoria']?></span>
                    <img src="<?php echo PATH_ESTUDIO?>uploads/<?php echo $value['img']?>" alt="Vaso">
                </div>
                <div class="card-content">
                    <h3 class="card-title"><?php echo $value['produto']?></h3>
                    
                    <div class="tech-specs">
                        <div class="spec-item"><i class="ph ph-clock"></i> <?php echo $value['tempo']?>h</div>
                        <div class="spec-item"><i class="ph ph-barbell"></i> <?php echo $value['qmu']?>g</div>
                        <div class="spec-item"><i class="ph ph-drop"></i> <?php echo $materiais[$value['material_id']-1]['nome']?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="price">R$ <?php echo implode(',',explode('.',$value['preco']))?></span>
                    <div style="display: flex; gap: 8px;">
                       <button class="btn-action btn-editar" data-id="<?php echo $value['id'];?>" title="Editar"><i class="ph ph-pencil-simple"></i></button>
                        <button class="btn-main-action"><i class="ph ph-printer"></i> Imprimir</button>
                    </div>
                </div>
            </article>
        <?php }?>

        <div class="modal-overlay" id="modalFormModelo">
            <div class="modal">
                <input type="hidden" name="id_modelo" id="edit_id">
                <div class="modal-header">
                    <h3>Novo modelo</h3>
                    <button class="close-modal" onclick="closeModal('modelo')">&times;</button>
                </div>
                
                <form enctype="multipart/form-data" method="post" id="novoModelo">
                    <div class="form-group">
                        <label class="form-label">Nome do Item</label>
                        <input type="text" class="form-input" name="produto" placeholder="Ex: Capivara Marrom 10cm" id="produto">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Material</label>
                            <select class="form-input" name="material_id" id="material_id">
                                <?php foreach ($materiais as $key => $value) {
                                    echo '<option value="'.$value['id'].'">'.$value['nome'].' '.$value['marca'].' '.$value['cor'].'</option>';
                                }?>
                            </select>
                        </div><!--form-group-->
                        <div class="form-group">
                            <label class="form-label">Quantidade (g)</label>
                            <input type="number" step="0.01" class="form-input" placeholder="1000g" name="qmu" id="qmu">
                        </div><!--form-group-->
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tempo total (h)</label>
                            <input type="number" step="0.01" class="form-input" placeholder="0.00" name="tempo" id="tempo">
                        </div><!--form-group-->
                        <div class="form-group">
                            <label class="form-label">Categoria</label>
                            <select class="form-input" name="categoria_id" id="categoria_id">
                                <?php foreach ($categorias as $key => $value) {
                                    echo '<option value="'.$value['id'].'">'.$value['categoria'].'</option>';
                                }?>
                            </select>
                        </div><!--form-group-->
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Custo</label>
                            <input type="number" step="0.01" class="form-input" name="custo" id="display_custo" readonly>
                        </div><!--form-group-->
                        <div class="form-group">
                            <label class="form-label">Markup</label>
                            <input type="number" step="0.01" class="form-input" min="1" max="10" name="markup" id="markup">
                        </div><!--form-group-->
                    </div><!--form-row-->

                    <div class="form-group">
                        <label class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-input" name="preco" id="display_preco" readonly>
                    </div><!--form-group-->

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Arquivo do Modelo</label>
                            <label class="file-upload-wrapper">
                                <input type="file" class="file-input" accept=".gcode" id="modelFile" name="arquivo">
                                <div class="upload-content">
                                    <i class="ph ph-cloud-arrow-up upload-icon"></i>
                                    <span class="upload-text">Clique para carregar ou arraste</span>
                                    <span class="upload-hint">Suporta .gcode (Máx. 100MB)</span>
                                </div>
                            </label>
                        </div><!--form-group-->

                        <div class="form-group">
                            <label class="form-label">Imagem do Modelo</label>
                            <label class="file-upload-wrapper">
                                <input type="file" class="file-input" accept=".png,.jpg,.jpeg" id="modelImg" name="img">
                                <div class="upload-content">
                                    <i class="ph ph-cloud-arrow-up upload-icon"></i>
                                    <span class="upload-text">Clique para carregar ou arraste</span>
                                    <span class="upload-hint">Suporta .png, .jpg, .jpeg (Máx. 5MB)</span>
                                </div>
                            </label>
                        </div><!--form-group-->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" onclick="closeModal('modelo')">Cancelar</button>
                        <button type="submit" class="btn-save">Salvar Registro</button>
                    </div>
                </form>
            </div>
        </div><!--modal-overlay-->
    </div><!--catalog grid-->
</section><!--container-->
<script>
   const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active de todos
            filterBtns.forEach(b => b.classList.remove('active'));
            // Adiciona active no clicado
            btn.classList.add('active');
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variável para o temporizador de digitação (debounce)
        let timeoutDigitacao = null;

        // 1. Selecionando os elementos do DOM baseados nos IDs do seu HTML
        const elMaterial = document.getElementById('material_id');
        const elQmu      = document.getElementById('qmu');
        const elTempo    = document.getElementById('tempo');
        const elMarkup   = document.getElementById('markup');
        
        // Outputs (Campos onde aparecem os resultados)
        const elDisplayCusto = document.getElementById('display_custo');
        const elDisplayPreco = document.getElementById('display_preco');

        // Lista de inputs para adicionar os ouvintes de evento
        const inputsEntrada = [elMaterial, elQmu, elTempo, elMarkup];

        // 2. Função principal que chama o PHP
        function calcularValores() {
            const materialId = elMaterial.value;
            const qmu = elQmu.value;
            const tempo = elTempo.value;
            const markup = elMarkup.value;

            // Se não tiver material selecionado, não calcula
            if (!materialId) return;

            // Feedback visual: deixa os campos de valor meio transparentes enquanto calcula
            elDisplayCusto.style.opacity = "0.5";
            elDisplayPreco.style.opacity = "0.5";

            const formData = new FormData();
            formData.append('material_id', materialId);
            formData.append('qmu', qmu);
            formData.append('tempo', tempo);
            formData.append('markup', markup);

            // Chama o arquivo PHP criado anteriormente
            fetch('<?php echo PATH?>app/Controllers/calcular-preco.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    // Atualiza os inputs (usamos .value pois são inputs, não spans)
                    elDisplayCusto.value = data.custo;
                    elDisplayPreco.value = data.preco;
                } else {
                    console.error('Erro no cálculo:', data.erro);
                }
            })
            .catch(error => console.error('Erro na requisição:', error))
            .finally(() => {
                // Volta a opacidade ao normal
                elDisplayCusto.style.opacity = "1";
                elDisplayPreco.style.opacity = "1";
            });
        }

        // 3. Lógica do "Ao Digitar" (Debounce)
        function aoInteragir() {
            // Cancela o envio anterior se o usuário ainda estiver digitando
            clearTimeout(timeoutDigitacao);

            // Aguarda 500ms após a última tecla para enviar ao servidor
            timeoutDigitacao = setTimeout(() => {
                calcularValores();
            }, 500);
        }

        // 4. Adiciona os eventos a todos os campos
        inputsEntrada.forEach(input => {
            if(input) { // Verificação de segurança caso algum ID mude
                input.addEventListener('input', aoInteragir);  // Detecta digitação
                input.addEventListener('change', aoInteragir); // Detecta mudança de select
            }
        });

        document.querySelectorAll('.btn-editar-modelo').forEach(btn => {
            btn.addEventListener('click', function() {
                // Recupera os dados guardados no atributo data-modelo
                const dados = JSON.parse(this.getAttribute('data-modelo'));
                
                // Chama sua função de preencher
                openEditarModal(dados);
            });
        });

        const botoesEditar = document.querySelectorAll('.btn-editar');

        botoesEditar.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                openModal('modelo'); 
                
                // 2. Chama o PHP para buscar os dados reais
                fetch(`<?php echo PATH?>app/Controllers/get-modelos.php?id=${id}`) // Ajuste o caminho!
                    .then(response => response.json())
                    .then(dados => {
                        if(dados.erro) {
                            alert(dados.erro);
                            return;
                        }
                        
                        // 3. Preenche os inputs com os dados que vieram do banco
                        // OBS: Certifique-se que os IDs dos inputs no modal de edição sejam estes:
                        document.getElementById('edit_id').value = dados.id;
                        document.getElementById('produto').value = dados.produto;
                        document.getElementById('material_id').value = dados.material_id;
                        document.getElementById('qmu').value = dados.qmu;
                        document.getElementById('tempo').value = dados.tempo;
                        document.getElementById('markup').value = dados.markup;
                        
                        // Dispara o cálculo automático para atualizar os preços na tela
                        // (Supondo que você criou a função 'calcularValoresEdit' para o segundo modal)
                        if (typeof calcularValoresEdit === "function") {
                            calcularValoresEdit(); 
                        }
                    })
                    .catch(erro => {
                        console.error('Erro:', erro);
                        alert('Erro ao buscar dados do modelo.');
                    });
            });
        });
    });
</script>
<script src="js/modal.js"></script>