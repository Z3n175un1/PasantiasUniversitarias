<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>500 - Internal Server Error</title>

    @vite('resources/css/app.css')

  <style>
    body{
      overflow:hidden;
      background:#020617;
    }

    .glow{
      box-shadow:
      0 0 30px rgba(59,130,246,.4),
      0 0 80px rgba(59,130,246,.2);
    }

    .float{
      animation: float 5s ease-in-out infinite;
    }

    @keyframes float{
      0%,100%{
        transform: translateY(0px);
      }
      50%{
        transform: translateY(-12px);
      }
    }

    .grid-bg{
      background-image:
      linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);

      background-size:40px 40px;
    }

    .scanline::before{
      content:'';
      position:absolute;
      inset:0;
      background:
      linear-gradient(
        to bottom,
        transparent 50%,
        rgba(255,255,255,.02) 51%
      );

      background-size:100% 4px;
      pointer-events:none;
    }

    .glitch{
      position:relative;
    }

    .glitch::before,
    .glitch::after{
      content:attr(data-text);
      position:absolute;
      left:0;
      top:0;
      width:100%;
    }

    .glitch::before{
      color:#38bdf8;
      animation: glitch1 .6s infinite;
      z-index:-1;
    }

    .glitch::after{
      color:#818cf8;
      animation: glitch2 .6s infinite;
      z-index:-2;
    }

    @keyframes glitch1{
      0%{transform:translate(0)}
      20%{transform:translate(-2px,2px)}
      40%{transform:translate(-2px,-2px)}
      60%{transform:translate(2px,2px)}
      80%{transform:translate(2px,-2px)}
      100%{transform:translate(0)}
    }

    @keyframes glitch2{
      0%{transform:translate(0)}
      20%{transform:translate(2px,-2px)}
      40%{transform:translate(2px,2px)}
      60%{transform:translate(-2px,-2px)}
      80%{transform:translate(-2px,2px)}
      100%{transform:translate(0)}
    }
  </style>
</head>

<body class="grid-bg scanline relative h-screen flex items-center justify-center text-white">

  <!-- Blur background -->
  <div class="absolute top-[-150px] left-[-150px] w-[400px] h-[400px] bg-cyan-500/20 blur-3xl rounded-full"></div>
  <div class="absolute bottom-[-150px] right-[-150px] w-[450px] h-[450px] bg-indigo-500/20 blur-3xl rounded-full"></div>

  <!-- Main -->
  <div class="relative z-10 max-w-5xl w-full px-6">

    <div class="grid md:grid-cols-2 gap-12 items-center">

      <!-- LEFT -->
      <div>

        <h1
          data-text="500"
          class="glitch text-[110px] md:text-[170px] font-black leading-none"
        >
          500
        </h1>

        <h2 class="text-4xl md:text-5xl font-bold mt-4">
          Internal Server Error
        </h2>

        <p class="mt-6 text-slate-300 text-lg leading-relaxed">
          El servidor acaba de colapsar de la manera más miserable posible.
          Nuestros hamsters backend están trabajando para restaurar el sistema.
        </p>

        <!-- Terminal -->
        <div class="mt-8 bg-black/40 border border-cyan-400/20 rounded-2xl p-5 font-mono text-sm backdrop-blur-xl glow">

          <p class="text-red-400">
            [CRITICAL] Kernel panic detected
          </p>

          <p class="text-cyan-300 mt-2">
            Restarting microservices...
          </p>

          <p class="text-slate-400 mt-2">
            Attempt #7 failed
          </p>

          <div class="mt-4 h-2 bg-white/10 rounded-full overflow-hidden">
            <div class="h-full w-2/3 bg-gradient-to-r from-cyan-400 to-indigo-500 animate-pulse"></div>
          </div>

        </div>

        <!-- Buttons -->
        <div class="mt-8 flex flex-wrap gap-4">

          <button
            onclick="location.reload()"
            class="px-7 py-4 rounded-2xl bg-gradient-to-r from-cyan-500 to-indigo-600 hover:scale-105 transition-all duration-300 font-semibold shadow-lg shadow-cyan-500/30"
          >
            Reintentar
          </button>

          <a
            href="/"
            class="px-7 py-4 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300"
          >
            Volver al inicio
          </a>

        </div>

      </div>

      <!-- RIGHT -->
      <div class="flex justify-center">

        <div class="relative float">

          <!-- Glow -->
          <div class="absolute inset-0 bg-cyan-500/20 blur-3xl rounded-full"></div>

          <!-- GIF -->
          <img
            src="https://media1.tenor.com/m/2HxM8yrUDTAAAAAC/when-server-down-iceeramen.gif"
            alt="Server Down"
            class="relative z-10 rounded-3xl border border-cyan-400/20 shadow-2xl glow w-full max-w-md"
          >

        </div>

      </div>

    </div>

  </div>

</body>
</html>