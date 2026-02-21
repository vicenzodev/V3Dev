<style type="text/css">
	/* Tamanho específico para Modais de Confirmação */
.modal-sm {
    max-width: 400px;
    text-align: center; /* Centraliza tudo */
    padding: 40px 30px;
}

/* Wrapper do Ícone (Círculo colorido) */
.icon-wrapper {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 20px auto; /* Centraliza e dá margem inferior */
}

/* Variação de Perigo (Vermelho Suave) */
.danger-icon {
    background-color: #FEE2E2; /* Vermelho muito claro */
    color: #EF4444;            /* Vermelho vibrante */
}

/* Variação de Sucesso (Verde Suave - Caso precise futuramente) */
.success-icon {
    background-color: #D1FAE5;
    color: #10B981;
}

/* Texto do Modal */
.confirmation-content h3 {
    margin-bottom: 10px;
    color: var(--text-main);
    font-size: 1.25rem;
}

.confirmation-content p {
    font-size: 0.9rem;
    color: var(--text-muted);
    line-height: 1.5;
    margin-bottom: 30px;
}

/* Footer Centralizado */
.center-footer {
    justify-content: center; /* Sobrescreve o flex-end padrão */
    gap: 15px;
    margin-top: 0;
}

/* Botão de Perigo (Excluir) */
.btn-danger-action {
    background-color: #EF4444;
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.4); /* Sombra vermelha */
    transition: transform 0.2s, background 0.2s;
}

.btn-danger-action:hover {
    background-color: #DC2626;
    transform: translateY(-2px);
}

/* Ajuste no botão cancelar para ficar harmônico */
.btn-cancel {
    background: transparent;
    border: 1px solid var(--border-light);
    color: var(--text-main);
    font-weight: 500;
}
.btn-cancel:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
}
</style>
<div class="modal-overlay" id="confirmModal">
    <div class="modal modal-sm confirmation-card">
        
        <div class="icon-wrapper danger-icon">
            <i class="ph ph-warning"></i>
        </div>

        <div class="confirmation-content">
            <h3>Excluir este item?</h3>
            <p>Essa ação removerá o registro permanentemente do banco de dados. Você não poderá desfazer.</p>
        </div>

        <div class="modal-footer center-footer">
            <button class="btn-cancel" onclick="closeConfirmModal()">Cancelar</button>
            <button class="btn-danger-action" onclick="excluir()">Sim, excluir</button>
        </div>

    </div>
</div>

<script>
    const confirmModal = document.getElementById('confirmModal');

    let idParaExc = null;
    let bd = null;

    // Função para abrir
    function openConfirmModal(id,type) {
        idParaExc = id;
        bd = type;
        confirmModal.style.display = 'flex';
    }

    // Função para fechar
    function closeConfirmModal() {
        confirmModal.style.display = 'none';
    }

    // Exemplo: Adicionar evento aos botões de lixeira existentes
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault(); // Evita recarregar se for form/link
            openConfirmModal();
        });
    });

    // Fechar ao clicar fora
    confirmModal.addEventListener('click', (e) => {
        if (e.target === confirmModal) {
            closeConfirmModal();
        }
    });

    function excluir(){
        let page = null;
        switch(bd){
            case 'mt':
                page = 'delete-material'
            break;
            case 'ct':
                page = 'delete-custo'
            break;
            case 'catg':
                page = 'delete-categoria'
            break;
        }
        fetch('<?php echo PATH?>app/Controllers/'+page+'.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: idParaExc })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload(); // Recarrega a página para atualizar a tabela
                showToast('sucesso','Excluído com sucesso!');
            } else {
                showToast('erro','Erro');
            }
        })
        .catch(error => console.error('Erro:', error));
    }
</script>