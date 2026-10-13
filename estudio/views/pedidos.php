<section class="dashboard container">
    <div class="header-content" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div class="page-title">
            <h2>Gerenciador de Pedidos</h2>
            <p>Acompanhe o status das suas impressões e produções em andamento.</p>
        </div>
        <div>
            <button class="btn-add" onclick="openModal('pedido')">
                <i class="ph ph-plus"></i> Novo pedido
            </button>
        </div>
    </div>

    <div class="dashboard-main-grid" style="margin-top: 2rem; display: block;">
        
        <div class="left-column" style="width: 100%;">
            
            <div class="section-title">
                <span>Fila de Pedidos Ativos</span>
                <button class="btn-icon" title="Atualizar"><i class="ph ph-arrows-clockwise"></i></button>
            </div>

            <div class="printer-card active" style="border-color: var(--accent-primary); margin-bottom: 1.5rem;">
                <div class="printer-header">
                    <div>
                        <div class="printer-name">#1042 - Suporte Headset Articulado</div>
                        <div style="font-size: 0.85rem; color: #666; display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                            <i class="ph ph-user"></i> Marcos Silva | <i class="ph ph-cube"></i> PLA Preto
                        </div>
                    </div>
                    <span class="printer-status status-running" style="background: #E0F2FE; color: #0284C7;">Imprimindo</span>
                </div>
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <span>Progresso na Ender 3 V3</span>
                        <span>75% (restam 2h 15m)</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%; background: var(--accent-primary);"></div>
                    </div>
                </div>
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #E5E7EB; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: 700; color: var(--text-main);">R$ 45,00</span>
                    <a href="#" style="color: var(--accent-primary); font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 5px;">Ver detalhes <i class="ph ph-arrow-right"></i></a>
                </div>
            </div>

            <div class="printer-card" style="margin-bottom: 1.5rem;">
                <div class="printer-header">
                    <div>
                        <div class="printer-name">#1043 - Vaso Decorativo Low Poly</div>
                        <div style="font-size: 0.85rem; color: #666; display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                            <i class="ph ph-user"></i> Ana Costa | <i class="ph ph-cube"></i> PETG Translúcido
                        </div>
                    </div>
                    <span class="printer-status status-idle" style="background: #FEF3C7; color: #D97706;">Aguardando Fatiamento</span>
                </div>
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #E5E7EB; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: 600; color: var(--text-muted);">A Orçar</span>
                    <a href="#" style="color: var(--text-muted); font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 5px;"><i class="ph ph-calculator"></i> Gerar Orçamento</a>
                </div>
            </div>

            <div class="printer-card" style="margin-bottom: 1.5rem;">
                <div class="printer-header">
                    <div>
                        <div class="printer-name">#1044 - Action Figure Goku (30cm)</div>
                        <div style="font-size: 0.85rem; color: #666; display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                            <i class="ph ph-shopping-bag"></i> Venda Externa | <i class="ph ph-cube"></i> Resina
                        </div>
                    </div>
                    <span class="printer-status" style="background: var(--brand-shopee, #EE4D2D); color: white;">Shopee</span>
                </div>
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #E5E7EB; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: 700; color: var(--text-main);">R$ 180,00</span>
                    <a href="#" style="color: #16A34A; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 5px;"><i class="ph ph-check-circle"></i> Etiqueta Pronta</a>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-overlay" id="modalFormPedido">
        <div class="modal">
            <div class="modal-header">
                <h3>Novo Pedido</h3>
                <button class="close-modal" onclick="closeModal('pedido')">&times;</button>
            </div>
            
            <form method="post" id="formPedido" action="?route=novo-pedido">
                
                <div class="form-group">
                    <label class="form-label">Nome do Projeto / Peça</label>
                    <input type="text" class="form-input" name="nome_projeto" placeholder="Ex: Suporte Headset Articulado" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Cliente</label>
                        <input type="text" class="form-input" name="usuario_id" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Origem da Venda</label>
                        <select class="form-input" name="origem_venda" required>
                            <option value="Direto">Direto</option>
                            <option value="Shopee">Shopee</option>
                            <option value="Mercado Livre">Mercado Livre</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Modelo (Catálogo)</label>
                        <select class="form-input" name="catalogo_id">
                            <option value="">Personalizado / Fora do catálogo</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Material Gasto</label>
                        <select class="form-input" name="material_id">
                            <option value="">A definir...</option>
                            </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Peso Estimado (g)</label>
                        <input type="number" step="0.01" class="form-input" name="peso_estimado_g" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempo Máquina (h)</label>
                        <input type="number" step="0.01" class="form-input" name="tempo_estimado_h" placeholder="0.00">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Valor Total (R$)</label>
                        <input type="number" step="0.01" class="form-input" name="valor_total" placeholder="0.00" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-input" name="status" required>
                            <option value="pendente">Pendente</option>
                            <option value="fatiamento">Fatiamento</option>
                            <option value="imprimindo">Imprimindo</option>
                            <option value="concluido">Concluído</option>
                            <option value="enviado">Enviado</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('pedido')">Cancelar</button>
                    <button type="submit" class="btn-save" name="pedido-action">Salvar Pedido</button>
                </div>
            </form>
        </div>
    </div>

</section>
<script src="js/modal.js"></script>