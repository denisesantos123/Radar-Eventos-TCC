<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radar Eventos - Centralizador e API de Eventos</title>
    <!-- Fontes Modernas -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0052cc;
            --primary-hover: #0040a3;
            --primary-light: #f0f6ff;
            --primary-border: #cce0ff;
            --accent: #38bdf8;
            --bg-body: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #475569;
            --card-bg: #ffffff;
            --border: #e2e8f0;
            --success: #10b981;
            --error: #ef4444;
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-sm: 0 2px 4px rgba(0, 82, 204, 0.03), 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 10px 20px -5px rgba(0, 82, 204, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0, 82, 204, 0.06), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            color: var(--text-dark);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Header e Navegação */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .logo svg {
            width: 32px;
            height: 32px;
            fill: none;
            stroke: var(--primary);
            stroke-width: 2.5;
        }

        nav {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-btn {
            background-color: var(--primary);
            color: #ffffff;
            padding: 0.6rem 1.2rem;
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(0, 82, 204, 0.2);
        }

        .nav-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero {
            padding: 6rem 0 4rem;
            position: relative;
            background: radial-gradient(circle at top right, rgba(0, 82, 204, 0.05), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(56, 189, 248, 0.05), transparent 40%);
            border-bottom: 1px solid var(--border);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary-light);
            border: 1px solid var(--primary-border);
            color: var(--primary);
            padding: 0.4rem 1rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            line-height: 1.15;
            margin-bottom: 1.5rem;
            letter-spacing: -0.03em;
        }

        .hero-title span {
            color: var(--primary);
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.15rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            max-width: 550px;
        }

        .hero-ctas {
            display: flex;
            gap: 1rem;
        }

        .cta-primary {
            background-color: var(--primary);
            color: #ffffff;
            padding: 0.85rem 1.75rem;
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 6px 20px rgba(0, 82, 204, 0.25);
        }

        .cta-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .cta-secondary {
            background-color: #ffffff;
            color: var(--primary);
            border: 1px solid var(--border);
            padding: 0.85rem 1.75rem;
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .cta-secondary:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-border);
            transform: translateY(-2px);
        }

        /* Mockup do Aplicativo / Evento */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .visual-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            position: relative;
            z-index: 2;
            overflow: hidden;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .visual-glow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(0, 82, 204, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            top: -50px;
            right: -50px;
            z-index: 1;
            pointer-events: none;
        }

        .visual-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: var(--radius-md);
            margin-bottom: 1.25rem;
        }

        .visual-badge {
            background-color: var(--primary-light);
            color: var(--primary);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 0.75rem;
        }

        .visual-title {
            font-size: 1.35rem;
            margin-bottom: 0.5rem;
        }

        .visual-info {
            display: flex;
            justify-content: space-between;
            color: var(--text-muted);
            font-size: 0.85rem;
            border-top: 1px solid var(--border);
            padding-top: 0.75rem;
            margin-top: 0.75rem;
        }

        .visual-info span {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Seção Sobre (Problema & Público-Alvo) */
        .about-section {
            padding: 6rem 0;
            border-bottom: 1px solid var(--border);
            background-color: #ffffff;
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 4rem;
        }

        .section-header h2 {
            font-size: 2.25rem;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .section-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .about-card {
            background-color: var(--primary-light);
            border: 1px solid var(--primary-border);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            transition: var(--transition);
        }

        .about-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .about-card-icon {
            width: 48px;
            height: 48px;
            background-color: var(--primary);
            color: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .about-card-icon svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
        }

        .about-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .about-card p {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.7;
        }

        /* Seção Funcionalidades (3 Principais) */
        .features-section {
            padding: 6rem 0;
            border-bottom: 1px solid var(--border);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(0, 82, 204, 0.15);
        }

        .feature-icon-wrapper {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background-color: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.75rem;
            transition: var(--transition);
        }

        .feature-card:hover .feature-icon-wrapper {
            background-color: var(--primary);
            color: #ffffff;
            box-shadow: 0 6px 15px rgba(0, 82, 204, 0.2);
        }

        .feature-icon-wrapper svg {
            width: 28px;
            height: 28px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Galeria de Eventos */
        .gallery-section {
            padding: 6rem 0;
            background-color: #ffffff;
            border-bottom: 1px solid var(--border);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .event-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .event-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(0, 82, 204, 0.1);
        }

        .event-img-box {
            position: relative;
            height: 200px;
            overflow: hidden;
            background-color: var(--border);
        }

        .event-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .event-card:hover .event-img {
            transform: scale(1.06);
        }

        .event-cat-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            color: var(--primary);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            box-shadow: var(--shadow-sm);
        }

        .event-body {
            padding: 1.5rem;
        }

        .event-date-pill {
            color: var(--primary);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            display: block;
        }

        .event-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .event-desc {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
            line-height: 1.5;
        }

        .event-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            padding-top: 1rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .event-loc {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .event-loc svg {
            width: 16px;
            height: 16px;
            fill: none;
            stroke: var(--primary);
            stroke-width: 2;
        }

        /* Seção Cadastro de Eventos (Interativo) */
        .register-section {
            padding: 6rem 0;
            background-color: var(--bg-body);
            border-bottom: 1px solid var(--border);
        }

        .register-container {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 3.5rem;
            align-items: start;
        }

        .form-card {
            background-color: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            box-shadow: var(--shadow-md);
        }

        .form-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .form-card .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-control {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background-color: var(--bg-body);
            color: var(--text-dark);
            outline: none;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-helper-images {
            grid-column: span 2;
            margin-top: 0.5rem;
        }

        .form-helper-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            display: block;
        }

        .image-presets {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem;
        }

        .preset-btn {
            border: 2px solid transparent;
            border-radius: 8px;
            overflow: hidden;
            height: 60px;
            cursor: pointer;
            position: relative;
            transition: var(--transition);
        }

        .preset-btn img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preset-btn.active {
            border-color: var(--primary);
            transform: scale(1.05);
            box-shadow: var(--shadow-sm);
        }

        .preset-btn-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 82, 204, 0.85);
            color: #ffffff;
            font-size: 0.65rem;
            font-weight: bold;
            text-align: center;
            padding: 0.15rem 0;
        }

        .form-btn {
            grid-column: span 2;
            background-color: var(--primary);
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            padding: 0.9rem;
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 82, 204, 0.2);
        }

        .form-btn:hover {
            background-color: var(--primary-hover);
        }

        .form-btn svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
        }

        /* Lista de Eventos Simulado */
        .simulated-box {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .simulated-header h4 {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .simulated-header h4 span {
            background-color: var(--primary-light);
            color: var(--primary);
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
        }

        .simulated-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            max-height: 480px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }

        .simulated-item {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 1rem;
            display: flex;
            gap: 1rem;
            align-items: center;
            transition: var(--transition);
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(30px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .simulated-item img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            background-color: var(--border);
        }

        .simulated-info {
            flex: 1;
            min-width: 0;
        }

        .simulated-info h5 {
            font-size: 0.95rem;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.25rem;
        }

        .simulated-meta {
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            gap: 0.75rem;
        }

        .simulated-cat {
            background-color: var(--primary-light);
            color: var(--primary);
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
        }

        /* Seção Endpoints da API */
        .api-section {
            padding: 6rem 0;
            background-color: #ffffff;
        }

        .api-container {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 4rem;
            align-items: start;
        }

        .api-info-box h3 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }

        .api-info-box p {
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-size: 1.05rem;
        }

        .endpoint-group {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .endpoint-card {
            background-color: var(--bg-body);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: var(--transition);
        }

        .endpoint-card:hover {
            border-color: var(--primary);
            transform: translateX(5px);
            background-color: var(--primary-light);
        }

        .endpoint-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .endpoint-method {
            background-color: var(--primary);
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 0.35rem 0.6rem;
            border-radius: 6px;
        }

        .endpoint-path {
            font-family: monospace;
            font-weight: 700;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .endpoint-card:hover .endpoint-path {
            color: var(--primary);
        }

        .endpoint-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-left: auto;
            margin-right: 1.5rem;
            display: none;
        }

        @media (min-width: 640px) {
            .endpoint-desc {
                display: block;
            }
        }

        .endpoint-action-btn {
            background-color: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .endpoint-card:hover .endpoint-action-btn {
            background-color: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .endpoint-action-btn svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.5;
        }

        .playground-card {
            background-color: #0f172a;
            border-radius: var(--radius-lg);
            padding: 2rem;
            color: #94a3b8;
            box-shadow: var(--shadow-lg);
            position: relative;
        }

        .playground-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #1e293b;
            padding-bottom: 1rem;
            margin-bottom: 1.25rem;
        }

        .playground-dot {
            display: flex;
            gap: 0.4rem;
        }

        .playground-dot span {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        .playground-dot span:nth-child(1) { background-color: #ef4444; }
        .playground-dot span:nth-child(2) { background-color: #f59e0b; }
        .playground-dot span:nth-child(3) { background-color: #10b981; }

        .playground-title {
            color: #ffffff;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: monospace;
        }

        .playground-body {
            position: relative;
        }

        .playground-code {
            font-family: 'Fira Code', monospace;
            font-size: 0.85rem;
            line-height: 1.5;
            color: #38bdf8;
            overflow-x: auto;
            max-height: 350px;
            white-space: pre-wrap;
        }

        .keyword { color: #f472b6; }
        .string { color: #34d399; }
        .number { color: #fb923c; }
        .boolean { color: #a78bfa; }

        /* Rodapé */
        footer {
            background-color: var(--text-dark);
            color: #94a3b8;
            padding: 4rem 0 2rem;
            border-top: 1px solid #1e293b;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 4rem;
            margin-bottom: 3rem;
        }

        .footer-brand h4 {
            color: #ffffff;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-brand h4 svg {
            width: 28px;
            height: 28px;
            fill: none;
            stroke: #ffffff;
            stroke-width: 2.5;
        }

        .footer-brand p {
            font-size: 0.95rem;
            max-width: 450px;
            line-height: 1.6;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .footer-title {
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: #ffffff;
        }

        .footer-bottom {
            border-top: 1px solid #1e293b;
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
        }

        .footer-bottom p span {
            color: #38bdf8;
        }

        /* Toast de Feedback (Notificação) */
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background-color: #0f172a;
            color: #ffffff;
            padding: 1rem 1.5rem;
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 1000;
            transform: translateY(150%);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-left: 4px solid var(--success);
        }

        .toast.show {
            transform: translateY(0);
        }

        .toast svg {
            width: 20px;
            height: 20px;
            stroke: var(--success);
            stroke-width: 2.5;
            fill: none;
        }

        /* Responsividade */
        @media (max-width: 968px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .hero-desc {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-ctas {
                justify-content: center;
            }

            .about-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .register-container {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .api-container {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width, .form-btn, .form-helper-images {
                grid-column: span 1;
            }

            .image-presets {
                grid-template-columns: repeat(2, 1fr);
            }

            .nav-container {
                height: auto;
                padding: 1rem 0;
                flex-direction: column;
                gap: 1rem;
            }

            nav {
                flex-wrap: wrap;
                justify-content: center;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- Header / Barra de Navegação -->
    <header>
        <div class="container nav-container">
            <a href="#inicio" class="logo" id="nav-logo">
                <svg viewBox="0 0 32 32">
                    <circle cx="16" cy="16" r="14" />
                    <circle cx="16" cy="16" r="8" stroke-dasharray="4 2" />
                    <circle cx="16" cy="16" r="2" fill="currentColor" />
                </svg>
                Radar Eventos
            </a>
            <nav>
                <a href="#sobre" class="nav-link">Sobre</a>
                <a href="#funcionalidades" class="nav-link">Funcionalidades</a>
                <a href="#eventos" class="nav-link">Eventos</a>
                <a href="#cadastro" class="nav-link">Cadastrar Evento</a>
                <a href="#api" class="nav-link">API Hub</a>
                <a href="#cadastro" class="nav-btn">Divulgar Evento</a>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="inicio" class="hero">
            <div class="container hero-grid">
                <div class="hero-content">
                    <span class="hero-badge">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <circle cx="6" cy="6" r="4" fill="currentColor"/>
                        </svg>
                        API no Render Disponível
                    </span>
                    <h1 class="hero-title">Centralize e integre <span>eventos locais</span> com facilidade</h1>
                    <p class="hero-desc">Descubra as principais atividades culturais, esportivas e de tecnologia. Integre a plataforma ao seu aplicativo usando nossa API REST leve e rápida.</p>
                    <div class="hero-ctas">
                        <a href="#cadastro" class="cta-primary">Cadastrar Evento</a>
                        <a href="#api" class="cta-secondary">Documentação API</a>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="visual-glow"></div>
                    <article class="visual-card">
                        <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=600" alt="Evento Destaque" class="visual-img" id="visual-show-img">
                        <span class="visual-badge" id="visual-show-cat">MÚSICA</span>
                        <h3 class="visual-title" id="visual-show-title">Festival Blue Wave</h3>
                        <p class="event-desc" id="visual-show-desc">O maior festival de música indie à beira-mar com palcos iluminados em tons de azul e branco.</p>
                        <div class="visual-info">
                            <span id="visual-show-date">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                15 de Julho, 2026
                            </span>
                            <span id="visual-show-loc">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                Florianópolis - SC
                            </span>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Seção Sobre (Problema & Público-Alvo) -->
        <section id="sobre" class="about-section">
            <div class="container">
                <div class="section-header">
                    <h2>Entenda a Plataforma</h2>
                    <p>O Radar Eventos foi desenhado para mitigar a lacuna na divulgação descentralizada e unificar a busca de lazer urbano.</p>
                </div>
                <div class="about-grid">
                    <div class="about-card">
                        <div class="about-card-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3>O Problema</h3>
                        <p>Organizadores de eventos independentes muitas vezes carecem de canais diretos e estruturados para divulgar suas programações. Em contrapartida, moradores e turistas encontram dificuldades para descobrir eventos locais de forma centralizada e sem atritos tecnológicos.</p>
                    </div>
                    <div class="about-card">
                        <div class="about-card-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3>Público-Alvo</h3>
                        <p>Por um lado, <strong>produtores e organizadores de eventos</strong> urbanos em busca de promover seus shows, encontros ou workshops. Por outro, o <strong>público geral, estudantes e turistas</strong> interessados em cultura local e networking, além de desenvolvedores buscando alimentar outras soluções com dados de eventos.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção Funcionalidades -->
        <section id="funcionalidades" class="features-section">
            <div class="container">
                <div class="section-header">
                    <h2>Funcionalidades Principais</h2>
                    <p>Conheça os três pilares que tornam o Radar Eventos a solução completa para o TCC.</p>
                </div>
                <div class="features-grid">
                    <article class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3>Mapeamento Inteligente</h3>
                        <p>Busca rápida por geolocalização e categorias (música, esportes, tecnologia). Encontre instantaneamente o que está acontecendo ao seu redor de forma organizada.</p>
                    </article>
                    <article class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3>Cadastro Descomplicado</h3>
                        <p>Formulários modernos e ágeis integrados para que qualquer organizador envie eventos. Após submetido, os dados tornam-se disponíveis instantaneamente via API pública.</p>
                    </article>
                    <article class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg viewBox="0 0 24 24">
                                <path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <h3>API REST Hub</h3>
                        <p>Desenvolvida para integração imediata. Nossos endpoints retornam JSON limpo e bem formatado, facilitando a alimentação de novos aplicativos mobile ou sistemas web.</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- Galeria de Eventos em Destaque -->
        <section id="eventos" class="gallery-section">
            <div class="container">
                <div class="section-header">
                    <h2>Eventos em Destaque</h2>
                    <p>Confira algumas das atrações ilustrativas cadastradas em nossa plataforma.</p>
                </div>
                <div class="gallery-grid">
                    <!-- Evento 1 -->
                    <article class="event-card">
                        <div class="event-img-box">
                            <span class="event-cat-badge">Música</span>
                            <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=600" alt="Festival de Música Blue Wave" class="event-img">
                        </div>
                        <div class="event-body">
                            <span class="event-date-pill">15 Julho &bull; 18:00</span>
                            <h3 class="event-title">Festival Blue Wave</h3>
                            <p class="event-desc">O maior festival de música indie à beira-mar com palcos iluminados em tons de azul e branco.</p>
                            <div class="event-footer">
                                <span class="event-loc">
                                    <svg viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Florianópolis, SC
                                </span>
                                <span>R$ 120,00</span>
                            </div>
                        </div>
                    </article>

                    <!-- Evento 2 -->
                    <article class="event-card">
                        <div class="event-img-box">
                            <span class="event-cat-badge">Esportes</span>
                            <img src="https://images.unsplash.com/photo-1502224562085-639556652f33?q=80&w=600" alt="Maratona Noturna Radar 10K" class="event-img">
                        </div>
                        <div class="event-body">
                            <span class="event-date-pill">20 Agosto &bull; 20:00</span>
                            <h3 class="event-title">Maratona Noturna 10K</h3>
                            <p class="event-desc">Corrida noturna com circuito iluminado e kit atleta especial nas cores do Radar App.</p>
                            <div class="event-footer">
                                <span class="event-loc">
                                    <svg viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Florianópolis, SC
                                </span>
                                <span>Inscrição Grátis</span>
                            </div>
                        </div>
                    </article>

                    <!-- Evento 3 -->
                    <article class="event-card">
                        <div class="event-img-box">
                            <span class="event-cat-badge">Tecnologia</span>
                            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=600" alt="Workshop UI/UX Design" class="event-img">
                        </div>
                        <div class="event-body">
                            <span class="event-date-pill">05 Setembro &bull; 14:00</span>
                            <h3 class="event-title">Workshop de UI/UX</h3>
                            <p class="event-desc">Aprenda a projetar interfaces modernas utilizando a elegante paleta azul e branca de maneira intuitiva.</p>
                            <div class="event-footer">
                                <span class="event-loc">
                                    <svg viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Florianópolis, SC
                                </span>
                                <span>R$ 45,00</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Seção de Cadastro de Eventos (Página/Formulário para Cadastro) -->
        <section id="cadastro" class="register-section">
            <div class="container register-container">
                <div class="form-card">
                    <h3>Cadastro de Evento</h3>
                    <p class="subtitle">Insira os dados abaixo para divulgar seu evento. A simulação irá adicioná-lo instantaneamente à listagem e atualizar a visualização da API.</p>
                    
                    <form id="eventForm" onsubmit="handleFormSubmit(event)">
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label for="title">Título do Evento</label>
                                <input type="text" id="title" class="form-control" placeholder="Ex: Festival Universitário de Música" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="category">Categoria</label>
                                <select id="category" class="form-control" required>
                                    <option value="Música">Música</option>
                                    <option value="Esportes">Esportes</option>
                                    <option value="Tecnologia">Tecnologia</option>
                                    <option value="Gastronomia">Gastronomia</option>
                                    <option value="Outros">Outros</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price">Preço (Simulado)</label>
                                <input type="text" id="price" class="form-control" placeholder="Ex: R$ 50,00 ou Grátis" required>
                            </div>

                            <div class="form-group">
                                <label for="date">Data</label>
                                <input type="date" id="date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="time">Horário</label>
                                <input type="time" id="time" class="form-control" required>
                            </div>

                            <div class="form-group full-width">
                                <label for="location">Localização (Cidade - UF)</label>
                                <input type="text" id="location" class="form-control" placeholder="Ex: Florianópolis - SC" required>
                            </div>

                            <div class="form-group full-width">
                                <label for="description">Descrição Curta</label>
                                <textarea id="description" class="form-control" rows="3" placeholder="Escreva os detalhes mais importantes do evento..." required></textarea>
                            </div>

                            <div class="form-group full-width">
                                <label for="image_url">URL da Imagem de Capa</label>
                                <input type="url" id="image_url" class="form-control" value="https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=600" placeholder="Insira a URL ou clique em um dos atalhos abaixo..." required>
                            </div>

                            <div class="form-helper-images">
                                <span class="form-helper-label">Escolha uma imagem de evento padrão:</span>
                                <div class="image-presets">
                                    <div class="preset-btn active" onclick="selectPreset('https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=600', 'Música', this)">
                                        <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=150" alt="Música">
                                        <span class="preset-btn-label">Música</span>
                                    </div>
                                    <div class="preset-btn" onclick="selectPreset('https://images.unsplash.com/photo-1502224562085-639556652f33?q=80&w=600', 'Esportes', this)">
                                        <img src="https://images.unsplash.com/photo-1502224562085-639556652f33?q=80&w=150" alt="Esportes">
                                        <span class="preset-btn-label">Esportes</span>
                                    </div>
                                    <div class="preset-btn" onclick="selectPreset('https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=600', 'Tecnologia', this)">
                                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=150" alt="Tecnologia">
                                        <span class="preset-btn-label">Tecnologia</span>
                                    </div>
                                    <div class="preset-btn" onclick="selectPreset('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=600', 'Gastronomia', this)">
                                        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=150" alt="Gastronomia">
                                        <span class="preset-btn-label">Gastronomia</span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="form-btn">
                                <svg viewBox="0 0 24 24"><path d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Enviar Evento
                            </button>
                        </div>
                    </form>
                </div>

                <div class="simulated-box">
                    <div class="simulated-header">
                        <h4>Eventos Cadastrados <span>Simulação</span></h4>
                        <p class="event-desc">Eventos cadastrados recentemente aparecem aqui na lista local:</p>
                    </div>
                    <div class="simulated-list" id="simulatedList">
                        <!-- Itens aparecem dinamicamente -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção de Endpoints da API -->
        <section id="api" class="api-section">
            <div class="container api-container">
                <div class="api-info-box">
                    <span class="hero-badge">API Hub</span>
                    <h3>Endpoints da API</h3>
                    <p>Consulte diretamente a API publicada no Render. Clique nos links para abrir em uma nova aba ou selecione um para visualizar a resposta simulada em tempo real no nosso console interativo.</p>
                    
                    <div class="endpoint-group">
                        <!-- Endpoint Status -->
                        <a href="/api/status" target="_blank" class="endpoint-card" onclick="playEndpoint(event, '/api/status')">
                            <div class="endpoint-meta">
                                <span class="endpoint-method">GET</span>
                                <span class="endpoint-path">/api/status</span>
                            </div>
                            <span class="endpoint-desc">Status do Servidor</span>
                            <div class="endpoint-action-btn" title="Visualizar JSON">
                                <svg viewBox="0 0 24 24"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </a>

                        <!-- Endpoint Recurso 1 -->
                        <a href="/api/recurso1" target="_blank" class="endpoint-card" onclick="playEndpoint(event, '/api/recurso1')">
                            <div class="endpoint-meta">
                                <span class="endpoint-method">GET</span>
                                <span class="endpoint-path">/api/recurso1</span>
                            </div>
                            <span class="endpoint-desc">Listagem de Eventos</span>
                            <div class="endpoint-action-btn" title="Visualizar JSON">
                                <svg viewBox="0 0 24 24"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </a>

                        <!-- Endpoint Recurso 2 -->
                        <a href="/api/recurso2" target="_blank" class="endpoint-card" onclick="playEndpoint(event, '/api/recurso2')">
                            <div class="endpoint-meta">
                                <span class="endpoint-method">GET</span>
                                <span class="endpoint-path">/api/recurso2</span>
                            </div>
                            <span class="endpoint-desc">Categorias de Eventos</span>
                            <div class="endpoint-action-btn" title="Visualizar JSON">
                                <svg viewBox="0 0 24 24"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Painel Console JSON -->
                <div class="playground-card">
                    <div class="playground-header">
                        <div class="playground-dot">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="playground-title" id="console-url">GET /api/status</div>
                    </div>
                    <div class="playground-body">
                        <pre class="playground-code" id="json-console">{
  <span class="keyword">"status"</span>: <span class="string">"online"</span>,
  <span class="keyword">"app"</span>: <span class="string">"Radar App API"</span>,
  <span class="keyword">"versao"</span>: <span class="string">"1.0.0"</span>,
  <span class="keyword">"mensagem"</span>: <span class="string">"Conexão estabelecida com sucesso. Pronto para buscar e divulgar eventos!"</span>,
  <span class="keyword">"tema"</span>: {
    <span class="keyword">"nome"</span>: <span class="string">"Radar Eventos"</span>,
    <span class="keyword">"cores_principais"</span>: [
      <span class="string">"Azul"</span>,
      <span class="string">"Branco"</span>
    ]
  }
}</pre>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Rodapé -->
    <footer>
        <div class="container footer-grid">
            <div class="footer-brand">
                <h4>
                    <svg viewBox="0 0 32 32">
                        <circle cx="16" cy="16" r="14" stroke="#ffffff" stroke-width="2.5" fill="none"/>
                        <circle cx="16" cy="16" r="8" stroke="#ffffff" stroke-dasharray="4 2" fill="none"/>
                        <circle cx="16" cy="16" r="2" fill="#ffffff" />
                    </svg>
                    Radar Eventos
                </h4>
                <p>O Radar de Eventos é uma plataforma de código aberto para a centralização, filtragem e consumo de programações de eventos em cidades de médio e grande porte. Projeto integrador para o Trabalho de Conclusão de Curso (TCC).</p>
            </div>
            <div class="footer-links">
                <span class="footer-title">Navegação</span>
                <a href="#inicio">Início</a>
                <a href="#sobre">Sobre o Projeto</a>
                <a href="#funcionalidades">Funcionalidades</a>
                <a href="#cadastro">Divulgação de Eventos</a>
                <a href="#api">Endpoints da API</a>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; 2026 Radar Eventos - TCC. Todos os direitos reservados.</p>
            <p>Desenvolvido com <span>Laravel</span> e publicado no Render.</p>
        </div>
    </footer>

    <!-- Toast de Notificação -->
    <div class="toast" id="successToast">
        <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span id="toastMessage">Evento enviado com sucesso!</span>
    </div>

    <!-- Scripts de Interatividade -->
    <script>
        // Dados locais iniciais para a simulação
        const initialEvents = [
            {
                title: "Festival Blue Wave",
                category: "Música",
                date: "2026-07-15",
                time: "18:00",
                location: "Florianópolis - SC",
                price: "R$ 120,00",
                image_url: "https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=600",
                description: "O maior festival de música indie à beira-mar com palcos iluminados em tons de azul e branco."
            },
            {
                title: "Maratona Noturna 10K",
                category: "Esportes",
                date: "2026-08-20",
                time: "20:00",
                location: "Florianópolis - SC",
                price: "Grátis",
                image_url: "https://images.unsplash.com/photo-1502224562085-639556652f33?q=80&w=600",
                description: "Corrida noturna com circuito iluminado e kit atleta especial nas cores do Radar App."
            }
        ];

        // Carrega dados iniciais da simulação
        document.addEventListener("DOMContentLoaded", () => {
            const listContainer = document.getElementById("simulatedList");
            initialEvents.forEach(evt => appendSimulatedItem(evt));
            
            // Set input date to tomorrow by default
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            document.getElementById("date").value = tomorrow.toISOString().split('T')[0];
            document.getElementById("time").value = "19:00";
        });

        // Manipulação de presets de imagens
        function selectPreset(url, category, element) {
            document.getElementById("image_url").value = url;
            
            // Atualizar classes dos presets
            document.querySelectorAll(".preset-btn").forEach(btn => btn.classList.remove("active"));
            element.classList.add("active");
            
            // Alterar o select da categoria para corresponder ao preset
            const selectCategory = document.getElementById("category");
            if (category === "Música") selectCategory.value = "Música";
            if (category === "Esportes") selectCategory.value = "Esportes";
            if (category === "Tecnologia") selectCategory.value = "Tecnologia";
            if (category === "Gastronomia") selectCategory.value = "Gastronomia";
        }

        // Função para formatar JSON no console interativo
        function formatHighlightJson(obj) {
            const json = JSON.stringify(obj, null, 2);
            return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+-]?\d+)?)/g, function (match) {
                let cls = 'number';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) {
                        cls = 'keyword';
                    } else {
                        cls = 'string';
                    }
                } else if (/true|false/.test(match)) {
                    cls = 'boolean';
                }
                return '<span class="' + cls + '">' + match + '</span>';
            });
        }

        // Simulação do Console da API
        const mockResponses = {
            '/api/status': {
                status: "online",
                app: "Radar App API",
                versao: "1.0.0",
                mensagem: "Conexão estabelecida com sucesso. Pronto para buscar e divulgar eventos!",
                tema: {
                    nome: "Radar Eventos",
                    cores_principais: ["Azul", "Branco"]
                }
            },
            '/api/recurso1': {
                recurso: "eventos",
                descricao: "Este endpoint representa o Recurso 1 da API (Listagem de Eventos para o Radar).",
                status: "sucesso",
                dados: [
                    {
                        id: 1,
                        titulo: "Festival de Música Blue Wave",
                        categoria: "Música",
                        data: "2026-07-15",
                        local: "Florianópolis - SC"
                    },
                    {
                        id: 2,
                        titulo: "Maratona Noturna Radar 10K",
                        categoria: "Esportes",
                        data: "2026-08-20",
                        local: "Florianópolis - SC"
                    }
                ]
            },
            '/api/recurso2': {
                recurso: "categorias",
                descricao: "Este endpoint representa o Recurso 2 da API (Categorias de Eventos).",
                status: "sucesso",
                dados: [
                    { id: 1, nome: "Música", slug: "musica" },
                    { id: 2, nome: "Esportes", slug: "esportes" },
                    { id: 3, nome: "Tecnologia", slug: "tecnologia" }
                ]
            }
        };

        function playEndpoint(event, endpoint) {
            // Evitar que mude de página se clicado na ação interativa
            // Mas permitir target="_blank" ao clicar no card de fora
            // Para isso, tratamos o clique especificamente
            event.preventDefault();
            
            const consoleUrl = document.getElementById("console-url");
            const consoleCode = document.getElementById("json-console");
            
            consoleUrl.textContent = "GET " + endpoint;
            
            // Mostra animação de "loading" no console
            consoleCode.innerHTML = '<span class="keyword">Carregando dados da API...</span>';
            
            setTimeout(() => {
                let response = mockResponses[endpoint];
                if (endpoint === '/api/recurso1') {
                    // Adicionar dinamicamente os novos cadastrados se existirem
                    const customList = getCustomEvents();
                    if (customList.length > 0) {
                        // Clonar o objeto de mock para não poluir
                        response = JSON.parse(JSON.stringify(mockResponses[endpoint]));
                        customList.forEach((evt, idx) => {
                            response.dados.push({
                                id: 3 + idx,
                                titulo: evt.title,
                                categoria: evt.category,
                                data: evt.date,
                                local: evt.location
                            });
                        });
                    }
                }
                consoleCode.innerHTML = formatHighlightJson(response);
            }, 300);
        }

        // Funções para manipulação dos eventos personalizados em LocalStorage
        function getCustomEvents() {
            const raw = localStorage.getItem("radar_events_custom");
            return raw ? JSON.parse(raw) : [];
        }

        function saveCustomEvent(eventObj) {
            const list = getCustomEvents();
            list.unshift(eventObj);
            localStorage.setItem("radar_events_custom", JSON.stringify(list));
        }

        function appendSimulatedItem(evt) {
            const listContainer = document.getElementById("simulatedList");
            
            const item = document.createElement("div");
            item.className = "simulated-item";
            
            // Date formatting
            const [year, month, day] = evt.date.split('-');
            const formattedDate = day && month ? `${day}/${month}/${year}` : evt.date;

            item.innerHTML = `
                <img src="${evt.image_url}" alt="${evt.title}">
                <div class="simulated-info">
                    <h5>${evt.title}</h5>
                    <div class="simulated-meta">
                        <span class="simulated-cat">${evt.category}</span>
                        <span>${formattedDate} &bull; ${evt.time}</span>
                    </div>
                </div>
            `;
            
            // Insert at the top of the simulated list
            listContainer.insertBefore(item, listContainer.firstChild);
        }

        // Formulário Submit
        function handleFormSubmit(event) {
            event.preventDefault();
            
            const submitBtn = event.target.querySelector("button[type='submit']");
            const originalBtnHtml = submitBtn.innerHTML;
            
            // Mostra loading
            submitBtn.innerHTML = `
                <svg style="animation: spin 1s linear infinite;" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" stroke-dasharray="30 10" fill="none"/>
                </svg>
                Processando Envio...
            `;
            submitBtn.disabled = true;

            const newEvent = {
                title: document.getElementById("title").value,
                category: document.getElementById("category").value,
                price: document.getElementById("price").value,
                date: document.getElementById("date").value,
                time: document.getElementById("time").value,
                location: document.getElementById("location").value,
                description: document.getElementById("description").value,
                image_url: document.getElementById("image_url").value
            };

            setTimeout(() => {
                // Adiciona na simulação
                appendSimulatedItem(newEvent);
                saveCustomEvent(newEvent);

                // Atualizar o card do visualizador dinâmico no Hero
                document.getElementById("visual-show-title").textContent = newEvent.title;
                document.getElementById("visual-show-cat").textContent = newEvent.category.toUpperCase();
                document.getElementById("visual-show-desc").textContent = newEvent.description;
                document.getElementById("visual-show-img").src = newEvent.image_url;
                
                const [year, month, day] = newEvent.date.split('-');
                document.getElementById("visual-show-date").innerHTML = `
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    ${day}/${month}/${year}
                `;
                document.getElementById("visual-show-loc").innerHTML = `
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    ${newEvent.location}
                `;

                // Mostrar sucesso
                showToast("Evento cadastrado e API simulada atualizada!");
                
                // Limpar campos de texto
                document.getElementById("title").value = "";
                document.getElementById("description").value = "";
                document.getElementById("price").value = "";
                
                // Restaurar botão
                submitBtn.innerHTML = originalBtnHtml;
                submitBtn.disabled = false;
                
                // Rolar suavemente até o topo da página para ver o novo card no Hero
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                // Atualizar o console se estiver visualizando o recurso1
                const consoleUrl = document.getElementById("console-url");
                if (consoleUrl.textContent.includes('/api/recurso1')) {
                    playEndpoint(new Event('click'), '/api/recurso1');
                }
            }, 1000);
        }

        // Exibe o Toast
        function showToast(message) {
            const toast = document.getElementById("successToast");
            const toastMessage = document.getElementById("toastMessage");
            toastMessage.textContent = message;
            
            toast.classList.add("show");
            setTimeout(() => {
                toast.classList.remove("show");
            }, 4000);
        }
    </script>
    <style>
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</body>
</html>
