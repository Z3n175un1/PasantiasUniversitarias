<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>500 - Internal Server Error</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body{
      overflow: hidden;
      background: #0f172a;
    }

    .noise::before{
      content:'';
      position:absolute;
      inset:0;
      background-image:
      radial-gradient(rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 4px 4px;
      opacity:.15;
      pointer-events:none;
    }

    .float{
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float{
      0%,100%{
        transform: translateY(0px);
      }
      50%{
        transform: translateY(-12px);
      }
    }

    .rotateSlow{
      animation: rotateSlow 25s linear infinite;
    }

    @keyframes rotateSlow{
      from{
        transform: rotate(0deg);
      }
      to{
        transform: rotate(360deg);
      }
    }

    .glitch{
      position: relative;
      color: white;
    }

    .glitch::before,
    .glitch::after{
      content: attr(data-text);
      position: absolute;
      left: 0;
      width: 100%;
      overflow: hidden;
    }

    .glitch::before{
      animation: glitchTop 2s infinite linear alternate-reverse;
      color: #38bdf8;
      z-index: -1;
    }

    .glitch::after{
      animation: glitchBottom 1.5s infinite linear alternate-reverse;
      color: #818cf8;
      z-index: -2;
    }

    @keyframes glitchTop{
      0%{
        clip-path: inset(0 0 80% 0);
        transform: translate(-2px,-2px);
      }
      20%{
        clip-path: inset(10% 0 60% 0);
        transform: translate(2px,2px);
      }
      40%{
        clip-path: inset(40% 0 30% 0);
        transform: translate(-1px,1px);
      }
      60%{
        clip-path: inset(60% 0 10% 0);
        transform: translate(1px,-1px);
      }
      80%{
        clip-path: inset(20% 0 50% 0);
        transform: translate(2px,-2px);
      }
      100%{
        clip-path: inset(0 0 80% 0);
        transform: translate(0);
      }
    }

    @keyframes glitchBottom{
      0%{
        clip-path: inset(80% 0 0 0);
        transform: translate(2px,2px);
      }
      20%{
        clip-path: inset(60% 0 10% 0);
        transform: translate(-2px,0);
      }
      40%{
        clip-path: inset(30% 0 40% 0);
        transform: translate(1px,-1px);
      }
      60%{
        clip-path: inset(10% 0 60% 0);
        transform: translate(-1px,1px);
      }
      80%{
        clip-path: inset(50% 0 20% 0);
        transform: translate(2px,1px);
      }
      100%{
        clip-path: inset(80% 0 0 0);
        transform: translate(0);
      }
    }

    .pulseRing{
      animation: pulseRing 3s infinite;
    }

    @keyframes pulseRing{
      0%{
        transform: scale(.9);
        opacity:.6;
      }
      70%{
        transform: scale(1.1);
        opacity:0;
      }
      100%{
        opacity:0;
      }
    }

  </style>
</head>

<body class="noise relative flex items-center justify-center h-screen text-white">

  <!-- Background Blur -->
  <div class="absolute top-[-120px] left-[-120px] w-[400px] h-[400px] bg-cyan-500/20 blur-3xl rounded-full"></div>
  <div class="absolute bottom-[-150px] right-[-150px] w-[450px] h-[450px] bg-indigo-500/20 blur-3xl rounded-full"></div>

  <!-- Rotating circles -->
  <div class="absolute w-[700px] h-[700px] border border-cyan-400/10 rounded-full rotateSlow"></div>
  <div class="absolute w-[500px] h-[500px] border border-indigo-400/10 rounded-full rotateSlow"></div>

  <!-- Main -->
  <div class="relative z-10 text-center px-6">

    <!-- Pulse -->
    <div class="absolute inset-0 flex items-center justify-center">
      <div class="w-72 h-72 border border-cyan-400/20 rounded-full pulseRing"></div>
    </div>

    <!-- Error code -->
    <h1
      data-text="500"
      class="glitch text-[120px] md:text-[200px] font-black leading-none tracking-widest"
    >
      500
    </h1>

    <!-- Card -->
    <div class="mt-6 backdrop-blur-xl bg-white/5 border border-white/10 rounded-3xl p-8 md:p-10 max-w-2xl mx-auto shadow-2xl float">

      <h2 class="text-3xl md:text-4xl font-bold text-cyan-300">
        Internal Server Error
      </h2>

      <p class="mt-5 text-gray-300 leading-relaxed text-lg">
        Algo salió terriblemente mal dentro del servidor.
        Nuestro sistema encontró una condición inesperada
        y no pudo completar tu solicitud.
      </p>

      <!-- Fake terminal -->
      <div class="mt-8 bg-black/40 border border-white/10 rounded-2xl p-5 text-left font-mono text-sm overflow-hidden">

        <div class="flex gap-2 mb-4">
          <div class="w-3 h-3 rounded-full bg-red-500"></div>
          <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
          <div class="w-3 h-3 rounded-full bg-green-500"></div>
        </div>

        <p class="text-red-400">
          [ERROR] Connection terminated unexpectedly
        </p>

        <p class="text-cyan-300 mt-2">
          Attempting automatic recovery...
        </p>

        <div class="mt-4 w-full bg-white/10 rounded-full h-2 overflow-hidden">
          <div class="h-full w-2/3 bg-gradient-to-r from-cyan-400 to-indigo-500 animate-pulse rounded-full"></div>
        </div>

      </div>

      <!-- Buttons -->
      <div class="mt-10 flex flex-col md:flex-row gap-4 justify-center">

        <button
          onclick="location.reload()"
          class="px-8 py-4 rounded-2xl bg-gradient-to-r from-cyan-500 to-indigo-600 hover:scale-105 transition-all duration-300 font-semibold shadow-lg shadow-cyan-500/30"
        >
          Reintentar
        </button>

        <a
          href="/"
          class="px-8 py-4 rounded-2xl border border-white/15 hover:bg-white/10 transition-all duration-300 font-semibold"
        >
          Volver al inicio
        </a>

      </div>

      <!-- Footer -->
      <div class="mt-10 text-xs tracking-[0.4em] uppercase text-gray-500">
        SERVER STATUS · CRITICAL FAILURE
      </div>

    </div>

  </div>

</body>
</html>