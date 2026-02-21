<section class="camera container">
    <div class="header-content">
        <div class="page-title">
            <h2>Monitoramento em Tempo Real</h2>
            <p>Visualização direta da impressora via HTTPS.</p>
        </div>
        <button class="btn-add" onclick="location.reload()">
            <i class="ph ph-arrows-clockwise"></i> Atualizar
        </button>
    </div>

    <div class="crud-card" style="padding: 20px; display: flex; justify-content: center; background: #000;">
        <iframe 
            src="https://179.228.247.27:8888/minha_camera/" 
            width="1280"
            height="720" 
            style="border:none;pointer-events: none;"
            scrolling="no" 
            allowfullscreen>
        </iframe>
    </div>
</section><!--camera container-->