<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radar Eventos - API Hub</title>
    <!-- Importando fonte moderna -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);
            --primary-blue: #0066ff;
            --primary-blue-dark: #0044bb;
            --primary-blue-light: #e6f0ff;
            --accent-sky: #38bdf8;
            --text-main: #0f172a;
            --text-muted: #475569;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --shadow-sm: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.08), 0 8px 10px -6px rgb(0 0 0 / 0.08);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-gradient);
            background-attachment: fixed;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem 1rem;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Hero Area */
        .hero {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        /* Decorative gradient glow */
        .hero::before {
            content: '';
            position: absolute;
            top: -150px;
            right: -150px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.4) 0%, rgba(0, 102, 255, 0) 70%);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -150px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(0, 102, 255, 0.2) 0%, rgba(0, 102, 255, 0) 70%);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .logo-radar {
            width: 48px;
            height: 48px;
            background: var(--primary-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 800;
            font-size: 1.5rem;
            box-shadow: 0 4px 14px rgba(0, 102, 255, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(0, 102, 255, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(0, 102, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 102, 255, 0); }
        }

        .badge {
            display: inline-block;
            background: var(--primary-blue-light);
            color: var(--primary-blue);
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            border: 1px solid rgba(0, 102, 255, 0.15);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--text-main);
            margin: 1rem 0 0.5rem;
            letter-spacing: -0.02em;
        }

        h1 span {
            color: var(--primary-blue);
        }

        .subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: var(--text-muted);
            max-width: 650px;
            margin-bottom: 2.5rem;
            font-weight: 300;
        }

        /* Grid for Showcase/Features */
        .showcase-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .showcase-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .showcase-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: rgba(0, 102, 255, 0.2);
        }

        .card-img-wrapper {
            position: relative;
            height: 160px;
            background: #e2e8f0;
            overflow: hidden;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .showcase-card:hover .card-img {
            transform: scale(1.08);
        }

        .card-badge {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: rgba(15, 23, 42, 0.75);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            backdrop-filter: blur(4px);
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-body h3 {
            font-size: 1.15rem;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .card-body p {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            line-height: 1.5;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: var(--primary-blue);
            font-weight: 600;
        }

        /* Endpoints Section */
        .endpoints-section {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 18px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .endpoints-section h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-left: 1rem;
            border-left: 4px solid var(--primary-blue);
        }

        .endpoint-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .endpoint-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.25rem;
            background: var(--primary-blue-light);
            border: 1px solid rgba(0, 102, 255, 0.1);
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .endpoint-item:hover {
            background: #dbeafe;
            border-color: rgba(0, 102, 255, 0.25);
            transform: translateX(4px);
        }

        .endpoint-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .method-badge {
            background: var(--primary-blue);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
        }

        .endpoint-path {
            font-family: monospace;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .endpoint-desc {
            font-size: 0.875rem;
            color: var(--text-muted);
            display: none;
        }

        @media (min-width: 640px) {
            .endpoint-desc {
                display: block;
            }
        }

        .arrow-icon {
            color: var(--primary-blue);
            font-weight: bold;
        }

        /* Footer */
        .footer {
            margin-top: 2rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <main class="hero">
            <div class="hero-content">
                <div class="header-logo">
                    <div class="logo-radar">R</div>
                    <span class="badge">Radar App</span>
                </div>
                
                <h1>Radar <span>Eventos</span> API Hub</h1>
                <p class="subtitle">A plataforma de busca e divulgação de eventos do TCC. Explore nossa API simulada com retornos em formato JSON para alimentar o seu frontend.</p>

                <!-- Cards Demonstrativos de Eventos (Representando o aplicativo Radar) -->
                <div class="showcase-grid">
                    <!-- Evento 1 -->
                    <article class="showcase-card">
                        <div class="card-img-wrapper">
                            <span class="card-badge">Música</span>
                            <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=600" alt="Festival de Música Blue Wave" class="card-img">
                        </div>
                        <div class="card-body">
                            <h3>Festival Blue Wave</h3>
                            <p>O maior festival de música indie à beira-mar com palcos iluminados em tons de azul e branco.</p>
                            <div class="card-meta">
                                <span>15 Jul 2026</span>
                                <span>Florianópolis - SC</span>
                            </div>
                        </div>
                    </article>

                    <!-- Evento 2 -->
                    <article class="showcase-card">
                        <div class="card-img-wrapper">
                            <span class="card-badge">Esportes</span>
                            <img src="https://images.unsplash.com/photo-1502224562085-639556652f33?q=80&w=600" alt="Maratona Noturna Radar 10K" class="card-img">
                        </div>
                        <div class="card-body">
                            <h3>Maratona Noturna 10K</h3>
                            <p>Corrida noturna com circuito iluminado e kit atleta especial nas cores do Radar App.</p>
                            <div class="card-meta">
                                <span>20 Ago 2026</span>
                                <span>Florianópolis - SC</span>
                            </div>
                        </div>
                    </article>

                    <!-- Evento 3 -->
                    <article class="showcase-card">
                        <div class="card-img-wrapper">
                            <span class="card-badge">Tecnologia</span>
                            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=600" alt="Workshop UI/UX Design" class="card-img">
                        </div>
                        <div class="card-body">
                            <h3>Workshop de UI/UX</h3>
                            <p>Aprenda a projetar interfaces incríveis utilizando a elegante paleta azul e branca.</p>
                            <div class="card-meta">
                                <span>05 Set 2026</span>
                                <span>Florianópolis - SC</span>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- API Endpoints section -->
                <section class="endpoints-section">
                    <h2>Endpoints Disponíveis</h2>
                    <div class="endpoint-list">
                        <!-- Endpoint Status -->
                        <a href="/api/status" target="_blank" rel="noopener" class="endpoint-item">
                            <div class="endpoint-info">
                                <span class="method-badge">GET</span>
                                <span class="endpoint-path">/api/status</span>
                            </div>
                            <span class="endpoint-desc">Status de integridade da API</span>
                            <span class="arrow-icon">&rarr;</span>
                        </a>

                        <!-- Endpoint Eventos -->
                        <a href="/api/eventos" target="_blank" rel="noopener" class="endpoint-item">
                            <div class="endpoint-info">
                                <span class="method-badge">GET</span>
                                <span class="endpoint-path">/api/eventos</span>
                            </div>
                            <span class="endpoint-desc">Listagem completa dos eventos cadastrados</span>
                            <span class="arrow-icon">&rarr;</span>
                        </a>

                        <!-- Endpoint Categorias -->
                        <a href="/api/categorias" target="_blank" rel="noopener" class="endpoint-item">
                            <div class="endpoint-info">
                                <span class="method-badge">GET</span>
                                <span class="endpoint-path">/api/categorias</span>
                            </div>
                            <span class="endpoint-desc">Categorias com iconografia e cores de identidade</span>
                            <span class="arrow-icon">&rarr;</span>
                        </a>

                        <!-- Endpoint Destaques -->
                        <a href="/api/eventos/destaques" target="_blank" rel="noopener" class="endpoint-item">
                            <div class="endpoint-info">
                                <span class="method-badge">GET</span>
                                <span class="endpoint-path">/api/eventos/destaques</span>
                            </div>
                            <span class="endpoint-desc">Eventos em destaque para a página inicial</span>
                            <span class="arrow-icon">&rarr;</span>
                        </a>
                    </div>
                </section>
            </div>
        </main>
        
        <footer class="footer">
            <p>&copy; 2026 Radar Eventos - TCC &bull; Desenvolvido com Laravel</p>
        </footer>
    </div>
</body>
</html>
