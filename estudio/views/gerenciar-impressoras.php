<style type="text/css">
    /* --- LAYOUT ESPECÍFICO DESTA TELA --- */
        .printer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr; /* Webcam maior que controles */
            gap: 20px;
            margin-bottom: 20px;
        }

        /* --- WEBCAM FEED --- */
        .webcam-card {
            background: #000;
            border-radius: var(--radius);
            overflow: hidden;
            position: relative;
            aspect-ratio: 16/9;
            box-shadow: var(--shadow-card);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .webcam-feed {
            width: 100%; height: 100%; object-fit: cover; opacity: 0.9;
        }

        .live-badge {
            position: absolute; top: 15px; left: 15px;
            background: rgba(220, 38, 38, 0.9); color: white;
            font-size: 0.7rem; font-weight: 700;
            padding: 4px 8px; border-radius: 4px;
            display: flex; align-items: center; gap: 5px;
            animation: pulse 2s infinite;
        }
        .live-dot { width: 6px; height: 6px; background: white; border-radius: 50%; }

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.7; } 100% { opacity: 1; } }

        /* Overlay de Status sobre a Webcam */
        .print-overlay {
            position: absolute; bottom: 0; left: 0; right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
            padding: 30px 20px 20px 20px;
            color: white;
        }
        
        .overlay-info h3 { font-size: 1.2rem; margin-bottom: 5px; }
        .overlay-details { font-size: 0.85rem; opacity: 0.8; display: flex; gap: 15px; }

        /* --- CARD DE TEMPERATURA --- */
        .temp-card {
            background: var(--bg-card);
            border-radius: var(--radius);
            border: 1px solid var(--border-light);
            padding: 20px;
            display: flex; flex-direction: column; gap: 20px;
        }

        .temp-row {
            display: flex; align-items: center; justify-content: space-between;
        }
        
        .temp-visual {
            display: flex; align-items: center; gap: 12px;
        }
        
        .temp-icon {
            width: 40px; height: 40px; background: #F3F4F6;
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: var(--text-muted);
        }
        .temp-icon.hot { background: #FEE2E2; color: #EF4444; } /* Vermelho */
        .temp-icon.bed { background: #DBEAFE; color: #2563EB; } /* Azul */

        .temp-values { text-align: right; }
        .current-temp { font-size: 1.5rem; font-weight: 700; font-family: 'Montserrat', sans-serif; }
        .target-temp { font-size: 0.8rem; color: var(--text-muted); }

        /* Slider de Controle */
        .range-wrap { width: 100%; display: flex; align-items: center; gap: 10px; margin-top: 5px;}
        input[type=range] { flex: 1; accent-color: var(--accent-primary); }

        /* --- CARD DE MOVIMENTO (Jog Control) --- */
        .control-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            max-width: 200px;
            margin: 0 auto;
        }

        .btn-move {
            background: #F9FAFB; border: 1px solid var(--border-light);
            border-radius: 8px; padding: 12px;
            font-size: 1.2rem; color: var(--text-main);
            cursor: pointer; transition: 0.2s;
            display: flex; align-items: center; justify-content: center;
        }
        .btn-move:hover { background: var(--accent-primary); color: white; border-color: var(--accent-primary); }
        .btn-move:active { transform: scale(0.95); }
        .btn-home { font-size: 1rem; font-weight: 700; }

        .z-controls {
            display: flex; flex-direction: column; gap: 8px;
            justify-content: center; border-left: 1px solid var(--border-light);
            padding-left: 20px; margin-left: 20px;
        }

        /* --- TERMINAL --- */
        .terminal-card {
            background: #1e1e1e; /* Fundo escuro clássico de terminal */
            border-radius: var(--radius);
            padding: 20px;
            color: #10B981; /* Texto verde Matrix */
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            display: flex; flex-direction: column;
            height: 300px;
        }

        .terminal-output {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 15px;
            display: flex; flex-direction: column; gap: 5px;
        }
        
        .log-line { opacity: 0.8; }
        .log-line.warn { color: #F59E0B; }
        .log-line.error { color: #EF4444; }

        .terminal-input-wrapper {
            display: flex; gap: 10px; border-top: 1px solid #333; padding-top: 10px;
        }
        
        .cmd-input {
            background: transparent; border: none;
            color: white; font-family: inherit; width: 100%;
            outline: none;
        }

        /* Botões de Ação Rápida */
        .quick-actions {
            display: flex; gap: 10px; margin-bottom: 20px;
        }
        .btn-control {
            flex: 1; padding: 12px; border-radius: 8px;
            border: none; font-weight: 600; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: 0.2s;
        }
        .btn-pause { background: #FEF3C7; color: #D97706; }
        .btn-stop { background: #FEE2E2; color: #DC2626; }
        .btn-stop:hover { background: #DC2626; color: white; }

        /* Input Numérico Estilizado (Parece texto, mas é editável) */
        .temp-input-group {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 5px;
        }

        .temp-input {
            width: 50px;
            background: transparent;
            border: 1px solid transparent; /* Invisível até passar o mouse */
            border-bottom: 1px dashed var(--border-light); /* Linha sutil para indicar edição */
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-muted);
            text-align: right;
            padding: 2px 0;
            outline: none;
            transition: all 0.2s;
        }

        .temp-input:hover, .temp-input:focus {
            border-bottom: 1px solid var(--accent-primary);
            color: var(--text-main);
        }

        /* Remove as setinhas padrão do input number (Chrome/Safari/Edge) */
        .temp-input::-webkit-outer-spin-button,
        .temp-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /* Firefox */
        .temp-input {
            -moz-appearance: textfield;
        }

        .temp-label {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        @media (max-width: 900px) {
            .printer-grid { grid-template-columns: 1fr; }
        }
</style>
<section class="container impressora">
    <h2><span id="printerName">Impressora...</span></h2>
    <div class="printer-grid">
        <div class="webcam-card">
           <iframe
                src="https://vicenzo.dev:8443/minha_camera/" 
                width="1280"
                height="720" 
                style="border:none;pointer-events: none;"
                scrolling="no"
                class="webcam-feed"
                allowfullscreen>
            </iframe>
            
            <div class="live-badge">
                <div class="live-dot"></div> LIVE
            </div>

            <div class="print-overlay">
                <h3><span id="modelName">Aguardando...</span></h3>
                <div class="overlay-details">
                    <span id="tempoRestante"><i class="ph ph-clock"></i> Restante: ...</span>
                    <span id="camadas"><i class="ph ph-layers"></i> Camada: ...</span>
                    <span id="percentual"><i class="ph ph-percent"></i> Concluído: ...</span>
                </div>
                <div style="height: 4px; background: rgba(255,255,255,0.3); border-radius: 2px; margin-top: 10px; overflow: hidden;">
                    <div id="progressBar" style="height: 100%; width: 32%; background: var(--accent-primary);"></div>
                </div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 20px;">
            
            <div class="temp-card">
                <div class="temp-row">
                    <div class="temp-visual">
                        <div class="temp-icon hot"><i class="ph ph-thermometer-hot"></i></div>
                        <div style="flex: 1;">
                            <strong>Bico (Nozzle)</strong>
                            <div class="range-wrap">
                                <input type="range" id="nozzleSlider" min="0" max="300" value="210">
                            </div>
                        </div>
                    </div>
                    <div class="temp-values">
                        <div class="current-temp" id="nozzleCurrent">...</div>
                        
                        <div class="temp-input-group">
                            <span class="temp-label">Meta:</span>
                            <input type="number" id="nozzleInput" class="temp-input">
                            <span class="temp-label">°C</span>
                        </div>
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid var(--border-light);">

                <div class="temp-row">
                    <div class="temp-visual">
                        <div class="temp-icon bed"><i class="ph ph-squares-four"></i></div>
                        <div style="flex: 1;">
                            <strong>Mesa (Bed)</strong>
                            <div class="range-wrap">
                                <input type="range" id="bedSlider" min="0" max="110" value="60">
                            </div>
                        </div>
                    </div>
                    <div class="temp-values">
                        <div class="current-temp" id="bedCurrent">...</div>
                        
                        <div class="temp-input-group">
                            <span class="temp-label">Meta:</span>
                            <input type="number" id="bedInput" class="temp-input">
                            <span class="temp-label">°C</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quick-actions">
                <button class="btn-control btn-pause"><i class="ph ph-pause"></i> Pausar</button>
                <button class="btn-control btn-stop"><i class="ph ph-stop"></i> Cancelar</button>
            </div>

        </div>
    </div>

    <div class="printer-grid" style="grid-template-columns: 1fr 2fr;">
        
        <div class="temp-card">
            <h4 style="margin-bottom: 20px; text-align: center;">Controle de Eixos</h4>
            <div style="display: flex; justify-content: center;">
                
                <div class="control-grid">
                    <div></div> <button class="btn-move" title="+Y"><i class="ph ph-caret-up"></i></button>
                    <div></div> <button class="btn-move" title="-X"><i class="ph ph-caret-left"></i></button>
                    <button class="btn-move btn-home" id="home" title="Home All"><i class="ph ph-house"></i></button>
                    <button class="btn-move" title="+X" id="right"><i class="ph ph-caret-right"></i></button>
                    
                    <div></div>
                    <button class="btn-move" title="-Y"><i class="ph ph-caret-down"></i></button>
                    <div></div>
                </div>

                <div class="z-controls">
                    <button class="btn-move" title="+Z"><i class="ph ph-arrow-fat-up"></i></button>
                    <span style="text-align: center; font-weight: 700; color: var(--text-muted);">Z</span>
                    <button class="btn-move" title="-Z"><i class="ph ph-arrow-fat-down"></i></button>
                </div>

            </div>
            
            <div style="margin-top: 20px; text-align: center;">
                <span style="font-size: 0.8rem; color: var(--text-muted);">Passos (Steps):</span>
                <div style="display: flex; gap: 5px; justify-content: center; margin-top: 5px;">
                    <button class="filter-btn active">0.1mm</button>
                    <button class="filter-btn">1mm</button>
                    <button class="filter-btn">10mm</button>
                </div>
            </div>
        </div>

        <div class="terminal-card">
            <div class="terminal-output" id="terminalOutput">
                <div class="log-line">> Conectado a Klipper v0.11.0</div>
                <div class="log-line">> Firmware Ender 3 V3 KE pronto.</div>
                <div class="log-line">> Aquecendo Bico para 210°C...</div>
                <div class="log-line warn">> Aviso: Mesh de nivelamento carregada.</div>
                <div class="log-line">> Imprimindo camada 142...</div>
            </div>
            <div class="terminal-input-wrapper">
                <span style="color: #10B981;">></span>
                <input type="text" class="cmd-input" placeholder="Enviar comando G-Code (ex: G28, M104)..." id="gcodeInput">
            </div>
        </div>

    </div>
</section>

<script>
//_______________________________________GET_________________________________________________

    function atualizarDadosImpressora() {
        fetch('<?php echo PATH?>app/Controllers/impressora.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('nozzleCurrent').innerText = Math.round(data.nozzleTemp) + ' °C';
                document.getElementById('bedCurrent').innerText = Math.round(data.bedTemp0) + ' °C';
                document.getElementById('tempoRestante').innerText = 'Restante: '+new Date(data.printLeftTime * 1000).toISOString().slice(11, 19);
                document.getElementById('camadas').innerText = 'Camada: '+data.layer+' / '+data.TotalLayer;
                document.getElementById('percentual').innerText = data.printProgress+'%';
                document.getElementById('modelName').innerText = data.printFileName.split('/')[5];
                document.getElementById('printerName').innerText = data.hostname;
                document.getElementById('progressBar').style.width = data.printProgress + '%';
            } 
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
            // Opcional: Mostrar erro na tela se a conexão cair
        });
    }

    atualizarDadosImpressora();

    setInterval(atualizarDadosImpressora, 1000);

//_______________________________________POST_________________________________________________

    function enviarDadosImpressora(acao,temp){
        const formData = new FormData();
        formData.append('acao',acao);
        formData.append('temp',temp);

        fetch('<?php echo PATH?>app/Controllers/impressora.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .catch(error => {
            console.error('Erro na requisição:', error);
            // Opcional: Mostrar erro na tela se a conexão cair
        });
    }

    //Mudança de temperatura
    const nozzleInput = document.getElementById('nozzleInput');
    const bedInput = document.getElementById('bedInput');

    nozzleInput.addEventListener('change',(event) => {
        enviarDadosImpressora('bicoTemp',nozzleInput.value);
    });

    bedInput.addEventListener('change',(event) => {
        enviarDadosImpressora('mesaTemp',bedInput.value);
    });

    //Movimentação
    const home = document.getElementById('home');
    home.addEventListener('click',(event)=>{
        enviarDadosImpressora('home');
    });
</script>
<script type="text/javascript" src="<?php echo PATH_ESTUDIO?>js/impressoraData.js"></script>