<!DOCTYPE html>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="mobile-web-app-capable" content="yes">

```
<title>GG Player Web</title>

<!-- HLS.js para navegadores que não possuem HLS nativo -->
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<!-- Firebase -->
<script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-firestore-compat.js"></script>

<style>
    * {
        box-sizing: border-box;
        -webkit-tap-highlight-color: transparent;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        background: #0d0d0d;
        color: #fff;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    }

    body {
        min-height: 100vh;
        min-height: 100dvh;
        overflow: hidden;
    }

    button {
        font-family: inherit;
    }

    .hidden {
        display: none !important;
    }

    /* =========================
       LOGIN
       ========================= */

    #loginScreen {
        position: fixed;
        inset: 0;
        background: #0d0d0d;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 10;
    }

    .login-box {
        width: min(400px, 92vw);
        background: #1a1a1a;
        border: 1px solid #252525;
        border-radius: 14px;
        padding: 28px 22px;
        text-align: center;
        box-shadow: 0 12px 40px rgba(0,0,0,0.35);
    }

    .login-logo {
        width: 90px;
        max-width: 45%;
        height: auto;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .login-box h2 {
        margin: 0 0 8px;
        font-size: 22px;
    }

    .login-box p {
        color: #aaa;
        margin: 8px 0;
    }

    .id-box {
        background: #111;
        border: 1px solid #292929;
        border-radius: 8px;
        padding: 12px;
        margin: 15px 0;
        font-family: monospace;
        font-size: 14px;
        word-break: break-all;
    }

    .login-button {
        width: 100%;
        border: 0;
        border-radius: 8px;
        padding: 13px 16px;
        background: #007bff;
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
    }

    .login-button:disabled {
        opacity: .6;
        cursor: default;
    }

    #statusMsg {
        margin-top: 15px;
        min-height: 20px;
        color: #ffb300;
        font-size: 13px;
        line-height: 1.4;
    }

    .debug-info {
        margin-top: 10px;
        color: #777;
        font-size: 11px;
        line-height: 1.4;
        word-break: break-word;
    }

    /* =========================
       PLAYER
       ========================= */

    #mainScreen {
        position: fixed;
        inset: 0;
        display: flex;
        flex-direction: column;
        background: #0d0d0d;
    }

    .nav-tabs {
        flex: 0 0 auto;
        display: flex;
        gap: 8px;
        padding:
            max(10px, env(safe-area-inset-top))
            10px
            10px
            10px;
        background: #141414;
        border-bottom: 1px solid #222;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .tab-btn {
        flex: 0 0 auto;
        background: #222;
        color: #aaa;
        border: 0;
        padding: 9px 16px;
        border-radius: 18px;
        font-size: 14px;
        cursor: pointer;
    }

    .tab-btn.active {
        background: #007bff;
        color: #fff;
    }

    .content {
        min-height: 0;
        flex: 1;
        display: flex;
        overflow: hidden;
    }

    .sidebar {
        width: 240px;
        flex: 0 0 240px;
        background: #121212;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        padding: 10px;
        border-right: 1px solid #222;
    }

    .cat-item {
        padding: 11px 10px;
        cursor: pointer;
        color: #ccc;
        border-bottom: 1px solid #1a1a1a;
        font-size: 13px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        border-radius: 5px;
        margin-bottom: 2px;
    }

    .cat-item.active {
        color: #fff;
        font-weight: bold;
        background: #1a1a1a;
        border-left: 3px solid #007bff;
        padding-left: 7px;
    }

    .grid {
        min-width: 0;
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(135px, 1fr));
        gap: 12px;
        align-content: start;
    }

    .card {
        min-width: 0;
        background: #1a1a1a;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        padding: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        border: 1px solid #222;
        overflow: hidden;
    }

    .card:active {
        transform: scale(.98);
    }

    .card img {
        width: 100%;
        height: 135px;
        object-fit: contain;
        border-radius: 5px;
        background: #000;
        display: block;
    }

    .card .title {
        width: 100%;
        font-size: 12px;
        margin-top: 7px;
        color: #eee;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.25;
        min-height: 30px;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        color: #888;
        padding: 50px 20px;
    }

    .empty-state strong {
        display: block;
        color: #aaa;
        margin-bottom: 8px;
    }

    /* =========================
       PLAYER MODAL
       ========================= */

    #playerModal {
        position: fixed;
        inset: 0;
        background: #000;
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    .player-head {
        flex: 0 0 auto;
        min-height: 50px;
        padding:
            max(8px, env(safe-area-inset-top))
            10px
            8px
            10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        background: rgba(0,0,0,.92);
        position: relative;
        z-index: 2;
    }

    #playerTitle {
        flex: 1;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .close-player {
        width: auto;
        flex: 0 0 auto;
        border: 0;
        border-radius: 6px;
        padding: 7px 13px;
        background: #222;
        color: #fff;
        cursor: pointer;
    }

    .video-container {
        position: relative;
        flex: 1;
        min-height: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #000;
    }

    video {
        width: 100%;
        height: 100%;
        background: #000;
        object-fit: contain;
    }

    /* =========================
       MOBILE
       ========================= */

    @media (max-width: 700px) {
        .content {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            flex: 0 0 auto;
            height: 48px;
            display: flex;
            gap: 6px;
            overflow-x: auto;
            overflow-y: hidden;
            border-right: 0;
            border-bottom: 1px solid #222;
            padding: 6px;
        }

        .cat-item {
            flex: 0 0 auto;
            border: 0;
            padding: 8px 12px;
            margin: 0;
            max-width: 220px;
            border-radius: 15px;
            background: #1b1b1b;
        }

        .cat-item.active {
            border-left: 0;
            padding-left: 12px;
            background: #007bff;
            color: #fff;
        }

        .grid {
            padding: 10px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .card img {
            height: 150px;
        }
    }
</style>
```

</head>

<body>

```
<!-- =========================
     LOGIN
     ========================= -->

<div id="loginScreen">
    <div class="login-box">

        <img
            src="logo_gg.png"
            class="login-logo"
            alt="GG Player"
            onerror="this.style.display='none';"
        >

        <h2>GG Player Web</h2>

        <p>Seu ID:</p>

        <div class="id-box" id="deviceId">
            Carregando...
        </div>

        <button id="btnEntrar" class="login-button">
            Entrar
        </button>

        <div id="statusMsg"></div>

        <div id="debugInfo" class="debug-info"></div>

    </div>
</div>


<!-- =========================
     MAIN
     ========================= -->

<div id="mainScreen" class="hidden">

    <div class="nav-tabs">

        <button
            class="tab-btn active"
            id="btn-tv"
            onclick="carregarAba('tv')"
        >
            📺 TV
        </button>

        <button
            class="tab-btn"
            id="btn-filmes"
            onclick="carregarAba('filmes')"
        >
            🎬 Filmes
        </button>

        <button
            class="tab-btn"
            id="btn-series"
            onclick="carregarAba('series')"
        >
            🍿 Séries
        </button>

    </div>

    <div class="content">

        <div
            class="sidebar"
            id="categoryList"
        ></div>

        <div
            class="grid"
            id="mediaGrid"
        ></div>

    </div>

</div>


<!-- =========================
     PLAYER
     ========================= -->

<div id="playerModal" class="hidden">

    <div class="player-head">

        <span
            id="playerTitle"
            style="font-weight:bold;font-size:.9em;"
        ></span>

        <button
            class="close-player"
            onclick="fecharPlayer()"
        >
            ✕ Fechar
        </button>

    </div>

    <div class="video-container">

        <video
            id="mediaPlayer"
            controls
            playsinline
            preload="none"
            webkit-playsinline
        ></video>

    </div>

</div>
```

<script>

    /* =====================================================
       FIREBASE
       ===================================================== */

    const firebaseConfig = {
        apiKey: "AIzaSyC06Bn7C-llo0B0vIfE7Nxq5vkEhBk2U-w",
        authDomain: "gg-gestao.firebaseapp.com",
        projectId: "gg-gestao",
        storageBucket: "gg-gestao.firebasestorage.app",
        messagingSenderId: "499414114342",
        appId: "1:499414114342:web:8d8b9e4f89fff9179706e7"
    };

    if (!firebase.apps.length) {
        firebase.initializeApp(firebaseConfig);
    }

    const db = firebase.firestore();


    /* =====================================================
       ESTADO
       ===================================================== */

    let currentID =
        localStorage.getItem("device_id") ||
        "GG-" +
        Math.random()
            .toString(36)
            .substring(2, 9)
            .toUpperCase();

    localStorage.setItem("device_id", currentID);

    document.getElementById("deviceId").textContent = currentID;

    let playlist = {
        tv: [],
        filmes: [],
        series: []
    };

    let abaAtual = "tv";

    let hls = null;


    /* =====================================================
       LOGIN / CARREGAMENTO DA M3U
       ===================================================== */

    document.getElementById("btnEntrar").onclick = async function () {

        const button = document.getElementById("btnEntrar");
        const status = document.getElementById("statusMsg");
        const debug = document.getElementById("debugInfo");

        button.disabled = true;

        status.textContent = "Conectando ao Firebase...";
        debug.textContent = "";

        try {

            /* ---------------------------------------------
               1. BUSCAR DISPOSITIVO
               --------------------------------------------- */

            const doc = await db
                .collection("devices")
                .doc(currentID)
                .get();

            if (!doc.exists) {
                throw new Error("ID não cadastrado no painel.");
            }

            const data = doc.data();

            if (!data.authorized) {
                throw new Error("Dispositivo não autorizado.");
            }

            if (!data.fixed_url || !String(data.fixed_url).trim()) {
                throw new Error("Sem URL cadastrada no Firestore.");
            }


            /* ---------------------------------------------
               2. URL DA LISTA
               --------------------------------------------- */

            const m3uUrl = String(data.fixed_url).trim();

            status.textContent = "Baixando lista de canais...";


            /*
             * Mantém HTTP ou HTTPS exatamente como recebido.
             * encodeURIComponent protege ? & = etc.
             */

            const linkProxy =
                "proxy.php?url=" +
                encodeURIComponent(m3uUrl);


            /* ---------------------------------------------
               3. BUSCAR PELO PROXY
               --------------------------------------------- */

            const res = await fetch(
                linkProxy,
                {
                    method: "GET",
                    cache: "no-store",
                    headers: {
                        "Accept": "audio/x-mpegurl, application/x-mpegURL, text/plain, */*"
                    }
                }
            );


            if (!res.ok) {

                const errTxt = await res.text();

                throw new Error(
                    errTxt ||
                    ("Proxy retornou HTTP " + res.status)
                );
            }


            /* ---------------------------------------------
               4. LER TEXTO
               --------------------------------------------- */

            const text = await res.text();

            if (!text || !text.trim()) {
                throw new Error(
                    "O servidor retornou uma lista M3U vazia."
                );
            }


            /* ---------------------------------------------
               5. GARANTIR QUE É M3U
               --------------------------------------------- */

            const preview =
                text
                    .replace(/^\uFEFF/, "")
                    .trim()
                    .substring(0, 500)
                    .toUpperCase();

            /*
             * Algumas listas começam diretamente com #EXTINF.
             * Outras começam com #EXTM3U.
             *
             * Portanto não exigimos obrigatoriamente #EXTM3U.
             */

            status.textContent =
                "Processando lista...";


            /* ---------------------------------------------
               6. PARSER
               --------------------------------------------- */

            const totalCarregado =
                parseM3U(text);


            if (totalCarregado <= 0) {

                throw new Error(
                    "A lista foi baixada, mas nenhuma entrada válida foi encontrada."
                );
            }


            /* ---------------------------------------------
               7. DEBUG INTERNO
               --------------------------------------------- */

            debug.textContent =
                "Itens carregados: " +
                totalCarregado +
                " | TV: " +
                playlist.tv.length +
                " | Filmes: " +
                playlist.filmes.length +
                " | Séries: " +
                playlist.series.length;


            /* ---------------------------------------------
               8. ABRIR PLAYER
               --------------------------------------------- */

            document
                .getElementById("loginScreen")
                .classList.add("hidden");

            document
                .getElementById("mainScreen")
                .classList.remove("hidden");


            carregarAba("tv");


        } catch (error) {

            console.error(
                "GG PLAYER - ERRO:",
                error
            );

            status.textContent =
                "Erro ao carregar a lista.";

            debug.textContent =
                error && error.message
                    ? error.message
                    : String(error);

        } finally {

            button.disabled = false;

        }
    };


    /* =====================================================
       PARSER M3U ROBUSTO
       ===================================================== */

    function parseM3U(content) {

        playlist = {
            tv: [],
            filmes: [],
            series: []
        };


        /*
         * Remove BOM e normaliza quebras de linha.
         */

        const normalized =
            String(content)
                .replace(/^\uFEFF/, "")
                .replace(/\r\n/g, "\n")
                .replace(/\r/g, "\n");


        const lines =
            normalized.split("\n");


        let current = null;

        let totalCount = 0;


        for (
            let i = 0;
            i < lines.length;
            i++
        ) {

            const raw =
                lines[i];

            const line =
                raw.trim();


            if (!line) {
                continue;
            }


            /* ---------------------------------------------
               #EXTINF
               --------------------------------------------- */

            if (
                line
                    .toUpperCase()
                    .startsWith("#EXTINF:")
            ) {

                current = {
                    name: "Canal sem nome",
                    logo: "",
                    group: "Geral"
                };


                /*
                 * Nome = conteúdo depois da última vírgula.
                 *
                 * Exemplo:
                 *
                 * #EXTINF:-1 tvg-name="X",Canal X
                 */

                const comma =
                    line.lastIndexOf(",");

                if (comma !== -1) {

                    const name =
                        line
                            .substring(comma + 1)
                            .trim();

                    if (name) {
                        current.name = name;
                    }
                }


                /* tvg-name */

                const tvgName =
                    extrairAtributo(
                        line,
                        "tvg-name"
                    );

                if (tvgName) {
                    current.name =
                        tvgName;
                }


                /* tvg-logo */

                const logo =
                    extrairAtributo(
                        line,
                        "tvg-logo"
                    );

                if (logo) {
                    current.logo =
                        logo;
                }


                /* group-title */

                const group =
                    extrairAtributo(
                        line,
                        "group-title"
                    );

                if (group) {
                    current.group =
                        group;
                }


                continue;
            }


            /* ---------------------------------------------
               #EXTGRP
               --------------------------------------------- */

            if (
                line
                    .toUpperCase()
                    .startsWith("#EXTGRP:")
            ) {

                if (!current) {
                    current = {
                        name: "Canal sem nome",
                        logo: "",
                        group: "Geral"
                    };
                }

                const group =
                    line
                        .substring(
                            line.indexOf(":") + 1
                        )
                        .trim();

                if (group) {
                    current.group =
                        group;
                }

                continue;
            }


            /* ---------------------------------------------
               TAGS M3U QUE NÃO SÃO URLs
               --------------------------------------------- */

            if (line.startsWith("#")) {
                continue;
            }


            /* ---------------------------------------------
               URL DE STREAM
               --------------------------------------------- */

            /*
             * Aceitamos explicitamente HTTP e HTTPS.
             *
             * Também removemos espaços acidentais.
             */

            const isHttp =
                /^https?:\/\//i.test(line);


            if (!isHttp) {
                continue;
            }


            /*
             * Caso apareça uma URL sem #EXTINF,
             * ainda criamos o item.
             */

            if (!current) {

                current = {
                    name: "Canal sem nome",
                    logo: "",
                    group: "Geral"
                };
            }


            const item = {

                name:
                    current.name ||
                    "Canal sem nome",

                logo:
                    current.logo ||
                    "",

                group:
                    current.group ||
                    "Geral",

                url:
                    line

            };


            /* ---------------------------------------------
               CLASSIFICAÇÃO
               --------------------------------------------- */

            const groupUpper =
                item.group
                    .normalize("NFD")
                    .replace(
                        /[\u0300-\u036f]/g,
                        ""
                    )
                    .toUpperCase();


            const nameUpper =
                item.name
                    .normalize("NFD")
                    .replace(
                        /[\u0300-\u036f]/g,
                        ""
                    )
                    .toUpperCase();


            const urlLower =
                item.url.toLowerCase();


            const ehFilme =
                groupUpper.includes("FILME") ||
                groupUpper.includes("MOVIE") ||
                groupUpper.includes("VOD") ||
                urlLower.includes("/movie/") ||
                urlLower.includes("/movies/");


            const ehSerie =
                groupUpper.includes("SERIE") ||
                groupUpper.includes("SERIES") ||
                groupUpper.includes("TV SHOW") ||
                groupUpper.includes("SHOWS") ||
                urlLower.includes("/series/");


            /*
             * Nomes isolados com "FILME" ou "SERIE"
             * também ajudam quando a categoria da lista
             * está mal configurada.
             */

            const nomeEhFilme =
                nameUpper.includes("FILME");


            const nomeEhSerie =
                nameUpper.includes("SERIE") ||
                nameUpper.includes("SÉRIE");


            if (
                ehFilme ||
                nomeEhFilme
            ) {

                playlist.filmes.push(item);

            } else if (
                ehSerie ||
                nomeEhSerie
            ) {

                playlist.series.push(item);

            } else {

                /*
                 * Tudo que não for identificado como
                 * filme ou série vai para TV.
                 */

                playlist.tv.push(item);
            }


            totalCount++;


            /*
             * Muito importante:
             * o próximo #EXTINF começa outro item.
             */

            current = null;
        }


        console.log(
            "GG PLAYER - M3U carregada:",
            {
                total: totalCount,
                tv: playlist.tv.length,
                filmes: playlist.filmes.length,
                series: playlist.series.length
            }
        );


        return totalCount;
    }


    /* =====================================================
       EXTRAIR ATRIBUTOS DO EXTINF
       ===================================================== */

    function extrairAtributo(
        linha,
        atributo
    ) {

        const escaped =
            atributo.replace(
                /[-\/\\^$*+?.()|[\]{}]/g,
                "\\$&"
            );


        /*
         * Aceita:
         *
         * tvg-logo="..."
         *
         * tvg-logo='...'
         *
         */

        const regex =
            new RegExp(
                escaped +
                "\\s*=\\s*(?:\"([^\"]*)\"|'([^']*)')",
                "i"
            );


        const match =
            linha.match(regex);


        if (!match) {
            return "";
        }


        return (
            match[1] ||
            match[2] ||
            ""
        ).trim();
    }


    /* =====================================================
       CARREGAR ABA
       ===================================================== */

    function carregarAba(tipo) {

        abaAtual = tipo;


        document
            .querySelectorAll(".tab-btn")
            .forEach(
                button =>
                    button.classList.remove("active")
            );


        const selectedButton =
            document.getElementById(
                "btn-" + tipo
            );


        if (selectedButton) {
            selectedButton.classList.add("active");
        }


        const side =
            document.getElementById(
                "categoryList"
            );


        side.innerHTML = "";


        const lista =
            playlist[tipo] || [];


        /* ---------------------------------------------
           TODAS
           --------------------------------------------- */

        const allBtn =
            document.createElement("div");


        allBtn.className =
            "cat-item active";


        allBtn.textContent =
            "Todas (" +
            lista.length +
            ")";


        allBtn.onclick =
            function () {

                document
                    .querySelectorAll(".cat-item")
                    .forEach(
                        c =>
                            c.classList.remove("active")
                    );

                allBtn.classList.add("active");

                filtrar("");
            };


        side.appendChild(allBtn);


        /* ---------------------------------------------
           CATEGORIAS
           --------------------------------------------- */

        const grupos =
            [
                ...new Set(
                    lista
                        .map(
                            item =>
                                item.group || "Geral"
                        )
                )
            ]
            .sort(
                (a, b) =>
                    a.localeCompare(
                        b,
                        "pt-BR"
                    )
            );


        grupos.forEach(
            function (grupo) {

                const quantidade =
                    lista.filter(
                        item =>
                            item.group === grupo
                    ).length;


                const catBtn =
                    document.createElement("div");


                catBtn.className =
                    "cat-item";


                catBtn.textContent =
                    grupo +
                    " (" +
                    quantidade +
                    ")";


                catBtn.onclick =
                    function () {

                        document
                            .querySelectorAll(".cat-item")
                            .forEach(
                                c =>
                                    c.classList.remove("active")
                            );


                        catBtn.classList.add("active");

                        filtrar(grupo);
                    };


                side.appendChild(catBtn);
            }
        );


        filtrar("");
    }


    /* =====================================================
       FILTRAR / RENDERIZAR
       ===================================================== */

    function filtrar(grupo) {

        const grid =
            document.getElementById(
                "mediaGrid"
            );


        grid.innerHTML = "";


        const base =
            playlist[abaAtual] || [];


        const lista =
            grupo
                ? base.filter(
                    item =>
                        item.group === grupo
                )
                : base;


        if (!lista.length) {

            grid.innerHTML = `
                <div class="empty-state">
                    <strong>Nenhum item encontrado</strong>
                    <span>
                        Esta aba não possui itens disponíveis.
                    </span>
                </div>
            `;

            return;
        }


        const fragment =
            document.createDocumentFragment();


        lista.forEach(
            function (item) {

                const card =
                    document.createElement("div");

                card.className =
                    "card";


                const img =
                    document.createElement("img");


                /*
                 * Se não houver logo,
                 * simplesmente mostramos um fundo neutro.
                 */

                if (item.logo) {

                    img.src =
                        item.logo;

                } else {

                    img.src =
                        "data:image/svg+xml;charset=UTF-8," +
                        encodeURIComponent(`
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="300"
                                height="300"
                                viewBox="0 0 300 300"
                            >
                                <rect width="300" height="300" fill="#111"/>
                                <text
                                    x="150"
                                    y="150"
                                    fill="#777"
                                    font-family="Arial"
                                    font-size="22"
                                    text-anchor="middle"
                                >
                                    GG PLAYER
                                </text>
                            </svg>
                        `);
                }


                img.onerror =
                    function () {

                        this.onerror = null;

                        this.src =
                            "data:image/svg+xml;charset=UTF-8," +
                            encodeURIComponent(`
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="300"
                                    height="300"
                                >
                                    <rect
                                        width="300"
                                        height="300"
                                        fill="#111"
                                    />
                                    <text
                                        x="150"
                                        y="150"
                                        fill="#777"
                                        font-family="Arial"
                                        font-size="22"
                                        text-anchor="middle"
                                    >
                                        SEM CAPA
                                    </text>
                                </svg>
                            `);
                    };


                const title =
                    document.createElement("div");


                title.className =
                    "title";


                title.textContent =
                    item.name;


                card.appendChild(img);
                card.appendChild(title);


                card.onclick =
                    function () {

                        play(
                            item.url,
                            item.name
                        );
                    };


                fragment.appendChild(card);

            }
        );


        grid.appendChild(fragment);
    }


    /* =====================================================
       REPRODUÇÃO
       ===================================================== */

    async function play(
        url,
        titulo
    ) {

        const modal =
            document.getElementById(
                "playerModal"
            );


        const video =
            document.getElementById(
                "mediaPlayer"
            );


        const title =
            document.getElementById(
                "playerTitle"
            );


        title.textContent =
            titulo || "Reproduzindo";


        modal.classList.remove(
            "hidden"
        );


        /* ---------------------------------------------
           LIMPAR PLAYER ANTERIOR
           --------------------------------------------- */

        if (hls) {

            try {
                hls.destroy();
            } catch (e) {
                console.warn(e);
            }

            hls = null;
        }


        video.pause();

        video.removeAttribute("src");

        video.load();


        /*
         * iOS / Safari:
         *
         * usa HLS nativo quando disponível.
         */

        const nativeHls =
            video.canPlayType(
                "application/vnd.apple.mpegurl"
            );


        if (nativeHls) {

            video.src = url;

            try {
                await video.play();
            } catch (e) {
                console.log(
                    "Autoplay bloqueado pelo navegador.",
                    e
                );
            }

            return;
        }


        /*
         * Chrome / Edge / Firefox etc.
         *
         * HLS.js quando suportado.
         */

        if (
            typeof Hls !== "undefined" &&
            Hls.isSupported()
        ) {

            hls =
                new Hls({
                    enableWorker: true,
                    lowLatencyMode: true,
                    backBufferLength: 30
                });


            hls.loadSource(url);

            hls.attachMedia(video);


            hls.on(
                Hls.Events.MANIFEST_PARSED,
                function () {

                    video
                        .play()
                        .catch(
                            () => {}
                        );
                }
            );


            hls.on(
                Hls.Events.ERROR,
                function (
                    event,
                    data
                ) {

                    console.error(
                        "HLS ERROR:",
                        data
                    );


                    if (
                        data &&
                        data.fatal
                    ) {

                        switch (
                            data.type
                        ) {

                            case Hls.ErrorTypes.NETWORK_ERROR:

                                console.warn(
                                    "HLS network error."
                                );

                                hls.startLoad();

                                break;


                            case Hls.ErrorTypes.MEDIA_ERROR:

                                console.warn(
                                    "HLS media error."
                                );

                                hls.recoverMediaError();

                                break;


                            default:

                                console.error(
                                    "Erro HLS fatal."
                                );

                                hls.destroy();

                                break;
                        }
                    }
                }
            );


            return;
        }


        /*
         * Último fallback.
         */

        video.src = url;

        video
            .play()
            .catch(
                () => {}
            );
    }


    /* =====================================================
       FECHAR PLAYER
       ===================================================== */

    function fecharPlayer() {

        if (hls) {

            try {
                hls.destroy();
            } catch (e) {
                console.warn(e);
            }

            hls = null;
        }


        const video =
            document.getElementById(
                "mediaPlayer"
            );


        video.pause();

        video.removeAttribute("src");

        video.load();


        document
            .getElementById(
                "playerModal"
            )
            .classList.add(
                "hidden"
            );
    }

</script>

</body>
</html>
