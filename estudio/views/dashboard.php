
<section class="dashboard container">
    <div class="header-content">
        <div class="page-title">
            <h2>Visão Geral</h2>
            <p>Bem-vindo de volta, Heitor. Aqui está o resumo do seu estúdio hoje.</p>
        </div>
        <div style="font-size: 0.9rem; color: var(--text-muted); background: white; padding: 8px 16px; border-radius: 20px; border: 1px solid var(--border-light);">
            <i class="ph ph-calendar-blank"></i> <span id="currentDate">Data</span>
        </div>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-green"><i class="ph ph-currency-dollar"></i></div>
            <div class="stat-info">
                <h3>R$ 1.250</h3>
                <p>Receita Mensal</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-blue"><i class="ph ph-cube"></i></div>
            <div class="stat-info">
                <h3>34</h3>
                <p>Impressões Totais</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-purple"><i class="ph ph-clock"></i></div>
            <div class="stat-info">
                <h3>128h</h3>
                <p>Tempo de Máquina</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-orange"><i class="ph ph-film-reel"></i></div>
            <div class="stat-info">
                <h3>2.5kg</h3>
                <p>Filamento Gasto</p>
            </div>
        </div>
    </div>

    <div class="dashboard-main-grid">
        
        <div class="left-column">
            
            <div class="section-title">
                <span>Máquinas Ativas</span>
                <button class="btn-icon" title="Atualizar"><i class="ph ph-arrows-clockwise"></i></button>
            </div>

            <div class="printer-card active">
                <div class="printer-header">
                    <div>
                        <div class="printer-name">Ender 3 V3 KE</div>
                        <div style="font-size: 0.8rem; color: #666;">Arquivo: IronMan_Mask_V2.gcode</div>
                    </div>
                    <span class="printer-status status-running">Imprimindo</span>
                </div>
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <span>Progresso</span>
                        <span>75% (restam 2h 15m)</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%;"></div>
                    </div>
                </div>
            </div>

            <div class="printer-card">
                <div class="printer-header">
                    <div>
                        <div class="printer-name">Bambu Lab X1C</div>
                        <div style="font-size: 0.8rem; color: #666;">Aguardando comando</div>
                    </div>
                    <span class="printer-status status-idle">Ociosa</span>
                </div>
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <span>Temperatura</span>
                        <span>25°C / 0°C</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%;"></div>
                    </div>
                </div>
            </div>

            <div class="section-title" style="margin-top: 30px;">
                <span>Histórico de Receita (Últimos 6 meses)</span>
            </div>
            <div class="chart-placeholder">
                <div class="chart-bar" data-height="30%" data-label="JUL"></div>
                <div class="chart-bar" data-height="45%" data-label="AGO"></div>
                <div class="chart-bar" data-height="40%" data-label="SET"></div>
                <div class="chart-bar" data-height="70%" data-label="OUT"></div>
                <div class="chart-bar" data-height="60%" data-label="NOV"></div>
                <div class="chart-bar" data-height="85%" data-label="DEZ"></div>
            </div>

        </div>

        <div class="right-column">
            <div class="section-title">Atividade Recente</div>
            
            <div class="activity-card">
                <div class="activity-item">
                    <div class="activity-icon"><i class="ph ph-plus"></i></div>
                    <div class="activity-text">
                        <strong>Novo Modelo Adicionado</strong>
                        <span>Suporte Headset (STL)</span>
                        <span style="font-size: 0.7rem; color: #999;">Há 2 horas</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon"><i class="ph ph-check"></i></div>
                    <div class="activity-text">
                        <strong>Impressão Concluída</strong>
                        <span>Vaso Voronoi - PLA Silk</span>
                        <span style="font-size: 0.7rem; color: #999;">Há 5 horas</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon"><i class="ph ph-currency-dollar"></i></div>
                    <div class="activity-text">
                        <strong>Novo Custo Cadastrado</strong>
                        <span>Verniz Spray TekBond</span>
                        <span style="font-size: 0.7rem; color: #999;">Ontem</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon"><i class="ph ph-pencil-simple"></i></div>
                    <div class="activity-text">
                        <strong>Perfil Editado</strong>
                        <span>Ajuste de Retração PETG</span>
                        <span style="font-size: 0.7rem; color: #999;">Ontem</span>
                    </div>
                </div>
            </div>

            <div style="margin-top: 20px; background: var(--accent-primary); color: white; padding: 20px; border-radius: var(--radius); text-align: center;">
                <i class="ph ph-calculator" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <h4 style="margin-bottom: 10px;">Novo Orçamento</h4>
                <p style="font-size: 0.9rem; margin-bottom: 15px; opacity: 0.9;">Calcule o preço de venda para um cliente agora.</p>
                <button style="background: white; color: var(--accent-primary); border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; cursor: pointer; width: 100%;">Abrir Calculadora</button>
            </div>
        </div>

    </div>
</section><!--dashboard container-->
<script>
        // 1. Data Atual
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').innerText = new Date().toLocaleDateString('pt-BR', dateOptions);

        // 2. Animar Barras do Gráfico (Efeito visual)
        setTimeout(() => {
            const bars = document.querySelectorAll('.chart-bar');
            bars.forEach(bar => {
                const h = bar.getAttribute('data-height');
                bar.style.height = h;
            });
        }, 300); // Pequeno delay para a animação acontecer após o load

        // 3. Script Active Sidebar (Já incluído na lógica, mas reforçando)
        const currentLocation = window.location.href;
        const menuItems = document.querySelectorAll('.sidebar .nav-item');
        menuItems.forEach(item => {
            if(item.href === currentLocation || currentLocation.includes(item.getAttribute('href'))) {
                item.classList.add('active');
            }
        });
    </script>