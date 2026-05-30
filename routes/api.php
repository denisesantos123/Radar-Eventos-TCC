<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Radar Eventos
|--------------------------------------------------------------------------
|
| Aqui são definidas as rotas da API do aplicativo Radar Eventos.
| Todas as respostas são retornadas em formato JSON didático.
|
*/

// Rota de Status da API
Route::get('/status', function () {
    return response()->json([
        'status' => 'online',
        'app' => 'Radar App API',
        'versao' => '1.0.0',
        'mensagem' => 'Conexão estabelecida com sucesso. Pronto para buscar e divulgar eventos!',
        'tema' => [
            'nome' => 'Radar Eventos',
            'cores_principais' => ['Azul', 'Branco']
        ]
    ]);
});

// Rota para listar todos os eventos (Radar)
Route::get('/eventos', function () {
    return response()->json([
        [
            'id' => 1,
            'titulo' => 'Festival de Música Blue Wave',
            'descricao' => 'O maior festival de música indie à beira-mar, com palcos iluminados em tons de azul e branco.',
            'data' => '2026-07-15',
            'horario' => '18:00',
            'local' => 'Arena da Praia, Florianópolis - SC',
            'categoria' => 'Música',
            'imagem_url' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=600',
            'destaque' => true,
        ],
        [
            'id' => 2,
            'titulo' => 'Maratona Noturna Radar 10K',
            'descricao' => 'Corrida urbana noturna com direito a kit atleta especial nas cores azul e branco.',
            'data' => '2026-08-20',
            'horario' => '20:00',
            'local' => 'Av. Beira Mar Norte, Florianópolis - SC',
            'categoria' => 'Esportes',
            'imagem_url' => 'https://images.unsplash.com/photo-1502224562085-639556652f33?q=80&w=600',
            'destaque' => true,
        ],
        [
            'id' => 3,
            'titulo' => 'Workshop de UI/UX - Design Limpo e Moderno',
            'descricao' => 'Aprenda a criar interfaces elegantes com foco na paleta minimalista azul e branca.',
            'data' => '2026-09-05',
            'horario' => '14:00',
            'local' => 'Centro de Inovação Alpha, Florianópolis - SC',
            'categoria' => 'Tecnologia',
            'imagem_url' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=600',
            'destaque' => false,
        ]
    ]);
});

// Rota para listar as categorias dos eventos
Route::get('/categorias', function () {
    return response()->json([
        [
            'id' => 1,
            'nome' => 'Música',
            'slug' => 'musica',
            'icone' => 'music-note',
            'cor_identidade' => '#0056b3'
        ],
        [
            'id' => 2,
            'nome' => 'Esportes',
            'slug' => 'esportes',
            'icone' => 'run',
            'cor_identidade' => '#00bfff'
        ],
        [
            'id' => 3,
            'nome' => 'Tecnologia',
            'slug' => 'tecnologia',
            'icone' => 'laptop',
            'cor_identidade' => '#1e90ff'
        ],
        [
            'id' => 4,
            'nome' => 'Gastronomia',
            'slug' => 'gastronomia',
            'icone' => 'food-fork-drink',
            'cor_identidade' => '#002f6c'
        ]
    ]);
});

// Rota para obter os eventos em destaque (Home do App)
Route::get('/eventos/destaques', function () {
    return response()->json([
        [
            'id' => 1,
            'titulo' => 'Festival de Música Blue Wave',
            'descricao' => 'O maior festival de música indie à beira-mar, com palcos iluminados em tons de azul e branco.',
            'data' => '2026-07-15',
            'horario' => '18:00',
            'local' => 'Arena da Praia, Florianópolis - SC',
            'categoria' => 'Música',
            'imagem_url' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=600',
            'destaque' => true,
        ],
        [
            'id' => 2,
            'titulo' => 'Maratona Noturna Radar 10K',
            'descricao' => 'Corrida urbana noturna com direito a kit atleta especial nas cores azul e branco.',
            'data' => '2026-08-20',
            'horario' => '20:00',
            'local' => 'Av. Beira Mar Norte, Florianópolis - SC',
            'categoria' => 'Esportes',
            'imagem_url' => 'https://images.unsplash.com/photo-1502224562085-639556652f33?q=80&w=600',
            'destaque' => true,
        ]
    ]);
});

