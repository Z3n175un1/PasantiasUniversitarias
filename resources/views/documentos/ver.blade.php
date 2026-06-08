<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visor de Documento | UWorkFlow</title>
    <link rel="icon" href="{{ asset('uworkflow-logo.ico') }}">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @if(str_starts_with($doc->tipo_mime, 'application/pdf'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    @endif
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; color: #0f172a; }
        .viewer-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 24px 24px 60px;
        }
        .doc-header {
            background: white;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            padding: 20px 28px;
            margin-bottom: 24px;
        }
        .doc-viewer {
            background: white;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .doc-viewer iframe {
            width: 100%;
            height: 80vh;
            border: none;
        }
        .doc-viewer img {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
            padding: 20px;
        }
        #pdf-canvas-container {
            width: 100%;
            overflow: auto;
            background: #e2e8f0;
            position: relative;
        }
        #pdf-canvas-container canvas {
            display: block;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .pdf-toolbar {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            background: #1e293b;
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .pdf-toolbar button {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .pdf-toolbar button:hover { background: rgba(255,255,255,0.2); }
        .pdf-toolbar button:disabled { opacity: 0.4; cursor: default; }
        .pdf-toolbar .page-info { font-size: 14px; font-weight: 500; }
        .no-viewer {
            padding: 60px 20px;
            text-align: center;
            color: #64748b;
        }
        .no-viewer i { width: 48px; height: 48px; margin-bottom: 16px; }
        .no-viewer h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; }
        .file-icon-large {
            width: 64px; height: 64px;
            background: #eff6ff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .file-icon-large i { width: 28px; height: 28px; color: #3b82f6; }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
            margin-bottom: 16px;
        }
        .back-link:hover { color: #0f172a; }
        .badge-size {
            background: #f1f5f9;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
        }
    </style>
    @stack('styles')
</head>
<body class="overflow-x-hidden">
    @include('componentes.navbar')

    <div class="viewer-container">
        <a href="{{ url()->previous() }}" class="back-link">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Volver
        </a>

        {{-- Header --}}
        <div class="doc-header flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="file-icon-large">
                    <i data-lucide="{{ str_starts_with($doc->tipo_mime, 'application/pdf') ? 'file-text' : (str_starts_with($doc->tipo_mime, 'image/') ? 'image' : 'file') }}" class="w-7 h-7"></i>
                </div>
                <div>
                    <h1 class="text-lg font-bold">{{ $doc->nombre_original }}</h1>
                    <p class="text-sm text-slate-500 flex items-center gap-2 mt-1">
                        <span class="font-semibold text-slate-700">{{ $doc->tipoDocumento->nombre ?? 'Documento' }}</span>
                        <span class="text-slate-300">•</span>
                        <span class="badge-size">{{ round($doc->tamano_bytes / 1024, 1) }} KB</span>
                        <span class="text-slate-300">•</span>
                        <span class="text-xs">{{ $doc->perfilEstudiante->usuario->nombre ?? '' }} {{ $doc->perfilEstudiante->usuario->apellidos ?? '' }}</span>
                    </p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ asset('storage/' . $doc->ruta_almacenamiento) }}" download="{{ $doc->nombre_original }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Descargar
                </a>
            </div>
        </div>

        {{-- Viewer --}}
        <div class="doc-viewer">
            @if(str_starts_with($doc->tipo_mime, 'application/pdf'))
                <div id="pdf-viewer" style="width:100%">
                    <div class="pdf-toolbar">
                        <button id="prev-page" disabled>
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </button>
                        <span class="page-info">
                            Página <span id="page-num">1</span> / <span id="page-count">--</span>
                        </span>
                        <button id="next-page" disabled>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </button>
                        <span style="flex:1"></span>
                        <button id="zoom-out">
                            <i data-lucide="zoom-out" class="w-4 h-4"></i>
                        </button>
                        <span id="zoom-level" style="font-size:13px;font-weight:500;min-width:48px;text-align:center">100%</span>
                        <button id="zoom-in">
                            <i data-lucide="zoom-in" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div id="pdf-canvas-container">
                        <canvas id="pdf-canvas"></canvas>
                    </div>
                </div>
            @elseif(str_starts_with($doc->tipo_mime, 'image/'))
                <img src="{{ asset('storage/' . $doc->ruta_almacenamiento) }}" alt="{{ $doc->nombre_original }}">
            @else
                <div class="no-viewer">
                    <div class="file-icon-large">
                        <i data-lucide="file" class="w-7 h-7"></i>
                    </div>
                    <h3>Vista previa no disponible</h3>
                    <p class="text-sm text-slate-400 mb-4">Este tipo de archivo no puede visualizarse en el navegador.</p>
                    <a href="{{ asset('storage/' . $doc->ruta_almacenamiento) }}" download="{{ $doc->nombre_original }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm">
                        <i data-lucide="download" class="w-4 h-4"></i>
                        Descargar archivo
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            @if(str_starts_with($doc->tipo_mime, 'application/pdf'))
                const url = '{{ asset('storage/' . $doc->ruta_almacenamiento) }}';
                const container = document.getElementById('pdf-canvas-container');
                const canvas = document.getElementById('pdf-canvas');
                const ctx = canvas.getContext('2d');
                const pageNumSpan = document.getElementById('page-num');
                const pageCountSpan = document.getElementById('page-count');
                const prevBtn = document.getElementById('prev-page');
                const nextBtn = document.getElementById('next-page');
                const zoomInBtn = document.getElementById('zoom-in');
                const zoomOutBtn = document.getElementById('zoom-out');
                const zoomLevelSpan = document.getElementById('zoom-level');

                let pdfDoc = null;
                let pageNum = 1;
                let scale = 1.0;

                function renderPage(num) {
                    pdfDoc.getPage(num).then(page => {
                        const viewport = page.getViewport({ scale });
                        canvas.width = viewport.width;
                        canvas.height = viewport.height;
                        const renderCtx = { canvasContext: ctx, viewport };
                        return page.render(renderCtx).promise;
                    }).then(() => {
                        pageNumSpan.textContent = num;
                        prevBtn.disabled = num <= 1;
                        nextBtn.disabled = num >= pdfDoc.numPages;
                    });
                }

                function updateZoom() {
                    zoomLevelSpan.textContent = Math.round(scale * 100) + '%';
                    renderPage(pageNum);
                }

                pdfjsLib.getDocument(url).promise.then(pdf => {
                    pdfDoc = pdf;
                    pageCountSpan.textContent = pdf.numPages;
                    renderPage(1);
                });

                prevBtn.addEventListener('click', () => {
                    if (pageNum > 1) { pageNum--; renderPage(pageNum); }
                });
                nextBtn.addEventListener('click', () => {
                    if (pageNum < pdfDoc.numPages) { pageNum++; renderPage(pageNum); }
                });
                zoomInBtn.addEventListener('click', () => {
                    scale = Math.min(scale + 0.25, 3.0);
                    updateZoom();
                });
                zoomOutBtn.addEventListener('click', () => {
                    scale = Math.max(scale - 0.25, 0.5);
                    updateZoom();
                });
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>
