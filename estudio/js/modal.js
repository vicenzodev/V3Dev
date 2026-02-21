const material = document.getElementById('modalFormMaterial');
const custo = document.getElementById('modalFormCusto');
const modelo = document.getElementById('modalFormModelo');
const edit = document.getElementById('modalFormEdit');

function openModal(modal) {
    if(modal == 'material'){
        material.style.display = 'flex';
    }else if(modal == 'custo'){
        custo.style.display = 'flex';
    }else if(modal == 'modelo'){
        modelo.style.display = 'flex';
    }
}

function closeModal(modal) {
    if(modal == 'material'){
        material.style.display = 'none';
    }else if(modal == 'custo'){
        custo.style.display = 'none';
    }else if(modal == 'modelo'){
        modelo.style.display = 'none';
    }
}

// Fechar se clicar fora do modal
window.onclick = function(event) {
    if (event.target == material ||
        event.target == custo    ||
        event.target == modelo   ||
        event.target == edit   ) {
        closeModal();
    }
}

const fileInputs = document.querySelectorAll('.file-input');

fileInputs.forEach(input => {
    input.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            
            // 3. Encontra o "pai" (wrapper) deste input específico
            const wrapper = this.closest('.file-upload-wrapper');
            
            // 4. Busca os elementos visuais DENTRO desse wrapper
            const uploadText = wrapper.querySelector('.upload-text');
            const uploadIcon = wrapper.querySelector('.upload-icon');
            const uploadHint = wrapper.querySelector('.upload-hint');

            // --- Atualizações Visuais ---

            // Adiciona classe de sucesso ao wrapper
            wrapper.classList.add('has-file');

            // Atualiza o texto
            uploadText.innerText = fileName;
            uploadText.style.color = "var(--accent-primary)"; // Certifique-se que essa var existe ou use uma cor hex

            // Atualiza o ícone (Lógica inteligente para diferenciar imagem de arquivo)
            uploadIcon.classList.remove('ph-cloud-arrow-up');
            
            if (this.accept.includes('.png') || this.accept.includes('.jpg')) {
                // Se for o input de imagem
                uploadIcon.classList.add('ph-image'); 
            } else {
                // Se for o input de arquivo gcode/stl
                uploadIcon.classList.add('ph-file-code'); // ou 'ph-file-stl'
            }

            // Esconde a dica
            if (uploadHint) {
                uploadHint.style.display = 'none';
            }
        }
    });
});