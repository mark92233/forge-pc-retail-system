<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FORGE PC — Hardware & Services</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            font-family: 'DM Sans', sans-serif;
            color-scheme: dark;
            --bg: #090909;
            --surface: #111;
            --surface2: #171717;
            --text: #f4f4f2;
            --muted: #999a9d;
            --line: #292929;
            --accent: #ed252d;
            --accent2: #ff4249;
            --header: rgba(9,9,9,.88);
            --card: #111;
            --soft: #1b1b1b;
        }

        :root[data-theme="light"] {
            color-scheme: light;
            --bg: #f5f7fa;
            --surface: #fff;
            --surface2: #edf1f7;
            --text: #101827;
            --muted: #667085;
            --line: #dce2eb;
            --accent: #1763d5;
            --accent2: #3785f4;
            --header: rgba(248,250,253,.92);
            --card: #fff;
            --soft: #e9eef7;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; scroll-padding-top: 90px; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            transition: background .35s, color .35s;
        }

        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }
        button { cursor: pointer; }
        img { display: block; max-width: 100%; }
        .site-shell { overflow: hidden; min-height: 100vh; background: var(--bg); }

        .announcement {
            min-height: 34px;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 9px;
            background: var(--accent);
            color: #fff;
            font-size: 9px;
            letter-spacing: 1.25px;
            font-weight: 800;
            text-align: center;
        }

        .announcement a {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .announcement-pulse {
            height: 6px;
            width: 6px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 0 0 4px #ffffff26;
            animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
            50% { box-shadow: 0 0 0 8px #ffffff05; }
        }

        .header {
            height: 78px;
            padding: 0 7.2%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--header);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 26px;
            line-height: .8;
            font-weight: 900;
            letter-spacing: .3px;
        }

        .brand-mark {
            height: 38px;
            width: 38px;
            display: grid;
            place-items: center;
            background: var(--accent);
            color: #fff;
            transform: skew(-8deg);
        }

        .brand-name { display: flex; flex-direction: column; gap: 6px; }
        .brand-light { color: var(--accent); }

        .brand small {
            font-family: 'DM Sans', sans-serif;
            font-size: 7px;
            letter-spacing: 2px;
            font-weight: 700;
            color: var(--muted);
        }

        .nav { display: flex; align-items: center; gap: 32px; }
        .nav a {
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
            transition: color .2s;
        }
        .nav a:hover { color: var(--accent); }

        .header-actions { display: flex; align-items: center; gap: 12px; }

        .icon-btn {
            height: 37px;
            width: 37px;
            display: grid;
            place-items: center;
            background: var(--surface2);
            border: 1px solid var(--line);
            color: var(--text);
            border-radius: 50%;
        }

        .header-order {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--text);
            color: var(--bg);
            padding: 12px 15px;
            font-size: 10px;
            font-weight: 800;
        }

        .menu-toggle { display: none; }

        .hero {
            height: min(750px, calc(100vh - 112px));
            min-height: 620px;
            position: relative;
            display: flex;
            align-items: center;
            background: #090909;
            color: white;
            isolation: isolate;
        }

        .hero-image, .hero-overlay, .hero-grid {
            position: absolute;
            inset: 0;
            z-index: -1;
        }

        .hero-image {
            background-image: url('https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=2200&q=90');
            background-size: cover;
            background-position: center 53%;
            animation: heroZoom 16s ease-in-out infinite alternate;
        }

        @keyframes heroZoom { to { transform: scale(1.07); } }

        .hero-overlay {
            background:
                linear-gradient(90deg,rgba(5,5,5,.96),rgba(5,5,5,.82) 42%,rgba(5,5,5,.26)),
                linear-gradient(0deg,rgba(5,5,5,.72),transparent 40%);
        }

        .hero-grid {
            opacity: .13;
            background-image:
                linear-gradient(#ffffff22 1px,transparent 1px),
                linear-gradient(90deg,#ffffff22 1px,transparent 1px);
            background-size: 70px 70px;
            mask-image: linear-gradient(90deg,#000,transparent 85%);
        }

        .hero-content {
            width: min(1200px,86%);
            margin: 0 auto;
            position: relative;
            padding-bottom: 25px;
            animation: rise .9s .1s both;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--accent);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .light-eyebrow { color: white; }
        .eyebrow-line { width: 25px; height: 2px; background: var(--accent); }

        .hero h1, .section-heading h2, .builder-copy h2,
        .service-content h2, .why-copy h2, .faq-intro h2,
        .contact-text h2, .service-menu-heading h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(76px,10vw,142px);
            line-height: .78;
            letter-spacing: -2px;
            font-weight: 900;
            margin: 28px 0 25px;
        }

        .hero h1 span, .section-heading h2 span, .builder-copy h2 span,
        .service-content h2 span, .why-copy h2 span,
        .faq-intro h2 span, .contact-text h2 span,
        .service-menu-heading h2 span { color: var(--accent); }

        .hero-copy {
            max-width: 490px;
            color: #c1c1c1;
            font-size: 14px;
            line-height: 1.9;
        }

        .hero-actions { display: flex; gap: 12px; margin-top: 28px; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 22px;
            padding: 15px 19px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .2px;
            transition: transform .25s, background .25s, color .25s;
        }

        .btn:hover { transform: translateY(-3px); }
        .btn-primary { background: var(--accent); color: white; }
        .btn-primary:hover { background: var(--accent2); }
        .btn-ghost { border: 1px solid #ffffff65; color: white; }
        .btn-ghost:hover { background: #ffffff15; }

        .hero-proof {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-top: 55px;
        }

        .proof-avatars { display: flex; }
        .proof-avatars span {
            width: 27px;
            height: 27px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #272727;
            border: 2px solid #090909;
            margin-left: -5px;
            font-size: 10px;
            font-weight: 800;
        }

        .hero-proof strong { display: block; font-size: 11px; }
        .hero-proof small { color: #aaa; font-size: 9px; }
        .proof-divider { height: 30px; width: 1px; background: #ffffff50; margin: 0 10px; }
        .proof-rating { display: flex; align-items: center; gap: 7px; color: #f5c451; font-size: 10px; }

        .hero-side-note {
            position: absolute;
            right: 7%;
            top: 50%;
            writing-mode: vertical-rl;
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 8px;
            letter-spacing: 2px;
            color: #ffffffa0;
        }

        .hero-side-note i { width: 1px; height: 45px; background: var(--accent); }

        .hero-bottom {
            position: absolute;
            bottom: 25px;
            left: 7%;
            right: 7%;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 8px;
            letter-spacing: 2px;
            color: #ffffffa0;
        }

        .scroll-line { width: 55px; height: 1px; background: var(--accent); }

        .hero-card {
            position: absolute;
            right: 8%;
            bottom: 75px;
            width: 205px;
            padding: 22px;
            background: #111e;
            border: 1px solid #ffffff25;
            backdrop-filter: blur(12px);
        }

        .hero-card-label { display: block; color: #aaa; font-size: 8px; letter-spacing: 1.5px; margin-bottom: 12px; }
        .hero-card strong { font-family: 'Barlow Condensed'; font-size: 22px; line-height: .95; }
        .hero-card-icon { display: block; color: var(--accent); margin-top: 15px; }

        .trust-strip {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            padding: 27px 7%;
            background: var(--surface);
            border-bottom: 1px solid var(--line);
        }

        .trust-strip > div {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 5px 20px;
            border-right: 1px solid var(--line);
        }

        .trust-strip > div:first-child { padding-left: 0; }
        .trust-strip > div:last-child { border: 0; }
        .trust-strip i { color: var(--accent); width: 22px; height: 22px; }
        .trust-strip strong, .trust-strip small { display: block; }
        .trust-strip strong { font-size: 9px; letter-spacing: .7px; }
        .trust-strip small { font-size: 9px; color: var(--muted); margin-top: 5px; }

        .section { padding: 110px 7%; }
        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 40px;
            margin-bottom: 55px;
        }

        .section-heading h2 {
            font-size: clamp(58px,7vw,94px);
            margin: 22px 0 0;
        }

        .heading-aside { max-width: 360px; }
        .heading-aside p, .faq-intro p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.9;
            margin: 0 0 20px;
        }

        .text-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 10px;
            font-weight: 800;
            color: var(--accent);
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 10px;
        }

        .category-tile {
            min-height: 105px;
            display: flex;
            align-items: center;
            gap: 17px;
            padding: 20px;
            background: var(--surface);
            border: 1px solid var(--line);
            position: relative;
            transition: .25s;
        }

        .category-tile:hover { border-color: var(--accent); transform: translateY(-3px); }
        .category-icon { color: var(--accent); }
        .category-tile strong, .category-tile small { display: block; }
        .category-tile strong { font-size: 13px; }
        .category-tile small { color: var(--muted); font-size: 8px; letter-spacing: 1px; margin-top: 6px; }
        .category-arrow { margin-left: auto; color: var(--muted); }
        .category-index { position: absolute; right: 15px; bottom: 10px; color: var(--muted); opacity: .4; font-size: 9px; }

        .product-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            margin: 75px 0 25px;
        }

        .product-head h3 { font-family: 'Barlow Condensed'; font-size: 34px; margin: 8px 0 0; }
        .product-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; }

        .product-card {
            background: var(--card);
            border: 1px solid var(--line);
            transition: transform .3s,border .3s;
        }

        .product-card:hover { transform: translateY(-6px); border-color: var(--accent); }
        .product-image { height: 220px; background: var(--surface2); position: relative; overflow: hidden; }
        .product-image img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
        .product-card:hover .product-image img { transform: scale(1.06); }
        .product-tag { position: absolute; top: 13px; left: 13px; background: var(--accent); color: white; padding: 6px 9px; font-size: 8px; font-weight: 800; letter-spacing: .8px; }
        .product-add { position: absolute; right: 12px; bottom: 12px; border: 0; background: var(--text); color: var(--bg); width: 35px; height: 35px; display: grid; place-items: center; }
        .product-info { padding: 18px; }
        .product-type { color: var(--accent); font-size: 8px; font-weight: 800; letter-spacing: 1px; }
        .product-info h4 { font-size: 14px; margin: 10px 0 7px; }
        .product-info p { color: var(--muted); font-size: 10px; margin: 0; }
        .product-price { display: flex; align-items: center; gap: 10px; margin-top: 18px; }
        .product-price strong { font-size: 16px; }
        .product-price del { color: var(--muted); font-size: 10px; }

        .catalog-note {
            margin-top: 20px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 13px;
            background: var(--surface);
            color: var(--muted);
            font-size: 10px;
        }

        .catalog-note i { color: var(--accent); }
        .catalog-note a { color: var(--accent); font-weight: 800; margin-left: auto; }

        .builder-section {
            padding: 110px 7%;
            background: #0c0c0c;
            color: white;
            position: relative;
            isolation: isolate;
        }

        .builder-bg {
            position: absolute;
            inset: 0;
            z-index: -1;
            opacity: .15;
            background-image: url('https://images.unsplash.com/photo-1587202372634-32705e3bf49c?auto=format&fit=crop&w=1600&q=85');
            background-size: cover;
            background-position: center;
        }

        .builder-inner { max-width: 1250px; margin: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 90px; align-items: center; }
        .builder-copy h2 { font-size: clamp(65px,7vw,100px); }
        .builder-copy p { max-width: 460px; color: #aaa; font-size: 12px; line-height: 2; }
        .builder-points { display: grid; gap: 14px; margin: 28px 0; }
        .builder-points span { display: flex; align-items: center; gap: 10px; color: #ccc; font-size: 10px; }
        .builder-points i { color: var(--accent); width: 16px; }

        .builder-widget { background: #141414; border: 1px solid #ffffff25; padding: 30px; box-shadow: 0 25px 80px #0008; }
        .widget-top { display: flex; justify-content: space-between; align-items: center; padding-bottom: 25px; border-bottom: 1px solid #ffffff20; }
        .widget-kicker { color: #999; font-size: 8px; letter-spacing: 1.5px; }
        .widget-top h3 { font-family: 'Barlow Condensed'; font-size: 30px; margin: 8px 0 0; }
        .live-dot { color: #75d69a; font-size: 8px; font-weight: 800; letter-spacing: 1px; }
        .live-dot:before { content: ''; display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #75d69a; margin-right: 7px; }
        .widget-field { padding: 25px 0; border-bottom: 1px solid #ffffff20; }
        .widget-field label { display: block; font-size: 9px; color: #aaa; letter-spacing: 1px; font-weight: 800; margin-bottom: 15px; }
        .use-options { display: grid; grid-template-columns: repeat(4,1fr); gap: 7px; }
        .use-option { padding: 13px 5px; display: grid; justify-items: center; gap: 8px; background: #202020; border: 1px solid #333; color: #aaa; font-size: 9px; }
        .use-option i { width: 18px; }
        .use-option.active { background: #351719; border-color: var(--accent); color: white; }
        .budget-label { display: flex; justify-content: space-between; align-items: center; }
        .budget-label strong { color: white; font-size: 16px; }
        input[type="range"] { width: 100%; accent-color: var(--accent); }
        .range-labels { display: flex; justify-content: space-between; color: #888; font-size: 9px; }
        .widget-result { display: flex; align-items: center; gap: 15px; padding: 20px 0; }
        .result-icon { width: 43px; height: 43px; display: grid; place-items: center; background: #351719; color: var(--accent); }
        .widget-result span, .widget-result strong, .widget-result small { display: block; }
        .widget-result span { color: #888; font-size: 8px; letter-spacing: 1px; }
        .widget-result strong { font-size: 12px; margin: 5px 0; }
        .widget-result small { color: #999; font-size: 9px; }
        .widget-result > i:last-child { margin-left: auto; color: var(--accent); }
        .widget-submit { width: 100%; border: 0; background: var(--accent); color: white; padding: 15px; font-size: 10px; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 12px; }
        .widget-disclaimer { color: #777; font-size: 8px; line-height: 1.7; }

        .usecase-grid { display: grid; grid-template-columns: 1.2fr 1fr 1fr; gap: 12px; }
        .usecase-card { height: 470px; position: relative; overflow: hidden; color: white; background: #111; }
        .usecase-card img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s; }
        .usecase-card:hover img { transform: scale(1.07); }
        .usecase-shade { position: absolute; inset: 0; background: linear-gradient(0deg,#050505ed,transparent 75%); }
        .usecase-number { position: absolute; top: 22px; left: 22px; font-size: 9px; letter-spacing: 1px; }
        .usecase-content { position: absolute; bottom: 25px; left: 25px; right: 25px; }
        .usecase-content > span { color: #ff555b; font-size: 8px; font-weight: 800; letter-spacing: 1.2px; }
        .usecase-content h3 { font-family: 'Barlow Condensed'; font-size: 49px; line-height: .85; margin: 12px 0; }
        .usecase-content p { max-width: 240px; color: #bbb; font-size: 10px; line-height: 1.7; }
        .circle-link { position: absolute; right: 0; bottom: 0; width: 40px; height: 40px; display: grid; place-items: center; border: 1px solid #ffffff80; }

        .build-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 15px; }
        .build-card { background: var(--surface); border: 1px solid var(--line); transition: border .3s,transform .3s; }
        .build-card:hover, .build-card.selected { border-color: var(--accent); transform: translateY(-4px); }
        .build-image { height: 220px; position: relative; overflow: hidden; }
        .build-image img { width: 100%; height: 100%; object-fit: cover; }
        .build-number, .build-label { position: absolute; top: 15px; padding: 7px 9px; background: #090909c9; color: white; font-size: 8px; letter-spacing: 1px; }
        .build-number { left: 15px; }
        .build-label { right: 15px; }
        .build-content { padding: 23px; }
        .build-use { color: var(--accent); font-size: 8px; font-weight: 800; letter-spacing: 1px; }
        .build-content h3 { font-family: 'Barlow Condensed'; font-size: 32px; margin: 10px 0; }
        .build-content p { color: var(--muted); font-size: 10px; line-height: 1.8; min-height: 38px; }
        .build-content ul { padding: 0; list-style: none; display: grid; gap: 10px; margin: 20px 0; }
        .build-content li { display: flex; align-items: center; gap: 8px; font-size: 10px; color: var(--muted); }
        .build-content li i { color: var(--accent); width: 14px; }
        .build-bottom { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--line); padding-top: 17px; }
        .build-bottom strong { font-size: 12px; }
        .build-bottom button { border: 0; background: transparent; color: var(--accent); font-size: 9px; font-weight: 800; }
        .fine-print { color: var(--muted); font-size: 9px; margin-top: 20px; }

        .service-section { background: #101010; color: white; display: grid; grid-template-columns: 1fr 1fr; }
        .service-image { min-height: 650px; position: relative; }
        .service-image > img { width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0; }
        .service-image:after { content: ''; position: absolute; inset: 0; background: linear-gradient(0deg,#050505a8,transparent 60%); }
        .service-image-label { position: absolute; z-index: 2; left: 8%; bottom: 8%; display: flex; align-items: center; gap: 15px; font-size: 10px; letter-spacing: 1px; }
        .service-image-label i { color: var(--accent); width: 30px; height: 30px; }
        .service-image-label strong { font-size: 16px; }
        .service-content { padding: 90px 12%; align-self: center; }
        .service-content h2 { font-size: clamp(65px,7vw,95px); }
        .service-content p { color: #aaa; font-size: 11px; line-height: 2; }
        .service-steps { display: grid; gap: 20px; margin: 30px 0; }
        .service-steps > div { display: flex; gap: 17px; align-items: flex-start; }
        .service-steps > div > span { color: var(--accent); font-size: 11px; font-weight: 800; }
        .service-steps strong, .service-steps small { display: block; }
        .service-steps strong { font-size: 11px; }
        .service-steps small { color: #888; font-size: 9px; margin-top: 6px; }

        .service-menu { display: grid; grid-template-columns: .8fr 1.2fr; gap: 80px; }
        .service-menu-heading h2 { font-size: clamp(55px,6vw,80px); }
        .service-list a { display: flex; align-items: center; gap: 20px; padding: 22px 5px; border-bottom: 1px solid var(--line); transition: .2s; }
        .service-list a:hover { padding-left: 15px; color: var(--accent); }
        .service-list-icon { color: var(--accent); }
        .service-list-text { flex: 1; }
        .service-list-text strong, .service-list-text small { display: block; }
        .service-list-text strong { font-size: 13px; }
        .service-list-text small { color: var(--muted); font-size: 9px; margin-top: 6px; }
        .service-list-num { color: var(--muted); font-size: 9px; }
        .service-list-arrow { width: 15px; color: var(--muted); }

        .why-section { padding: 110px 7%; background: #0b0b0b; color: white; }
        .why-inner { display: grid; grid-template-columns: .9fr 1.1fr; gap: 80px; align-items: center; }
        .why-copy h2 { font-size: clamp(65px,7vw,100px); }
        .why-copy p { color: #aaa; font-size: 11px; line-height: 2; max-width: 410px; margin-bottom: 28px; }
        .btn-outline-light { border: 1px solid #ffffff60; color: white; }
        .why-visual { height: 490px; position: relative; }
        .why-visual > img { width: 100%; height: 100%; object-fit: cover; }
        .why-stamp { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%) rotate(-7deg); padding: 25px 35px; background: #ed252de8; color: white; text-align: center; white-space: nowrap; }
        .why-stamp span, .why-stamp strong { display: block; }
        .why-stamp span { font-size: 8px; letter-spacing: 2px; }
        .why-stamp strong { font-family: 'Barlow Condensed'; font-size: 40px; }
        .why-caption { position: absolute; bottom: 15px; left: 15px; right: 15px; display: flex; justify-content: space-between; color: white; font-size: 8px; letter-spacing: 1px; }
        .stats-row { display: grid; grid-template-columns: repeat(4,1fr); border-top: 1px solid #ffffff25; margin-top: 85px; padding-top: 30px; }
        .stats-row > div { display: flex; align-items: center; gap: 15px; border-right: 1px solid #ffffff25; padding: 5px 20px; }
        .stats-row > div:first-child { padding-left: 0; }
        .stats-row > div:last-child { border: 0; }
        .stats-row strong { color: var(--accent); font-family: 'Barlow Condensed'; font-size: 35px; }
        .stats-row span { color: #aaa; font-size: 8px; letter-spacing: .7px; line-height: 1.6; }

        .faq-section { display: grid; grid-template-columns: .8fr 1.2fr; gap: 90px; }
        .faq-intro h2 { font-size: clamp(55px,6vw,80px); }
        .faq-list { border-top: 1px solid var(--line); }
        .faq-item { border-bottom: 1px solid var(--line); }
        .faq-item summary { list-style: none; display: flex; align-items: center; gap: 20px; padding: 22px 0; cursor: pointer; }
        .faq-item summary::-webkit-details-marker { display: none; }
        .faq-num { color: var(--accent); font-size: 9px; }
        .faq-item summary strong { flex: 1; font-size: 12px; }
        .faq-plus { color: var(--accent); transition: transform .2s; }
        .faq-item[open] .faq-plus { transform: rotate(45deg); }
        .faq-item p { color: var(--muted); font-size: 11px; line-height: 1.9; padding: 0 35px 20px; margin: 0; }

        .contact-section { display: grid; grid-template-columns: 1fr 1fr; background: #101010; color: white; }
        .contact-text { padding: 100px 12%; align-self: center; }
        .contact-text h2 { font-size: clamp(65px,7vw,100px); }
        .contact-text p { color: #aaa; font-size: 11px; line-height: 2; max-width: 400px; }
        .contact-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 20px; margin-top: 30px; }
        .contact-secondary { font-size: 10px; color: #ccc; display: flex; gap: 10px; align-items: center; }
        .contact-art { position: relative; min-height: 550px; overflow: hidden; }
        .contact-art img { width: 100%; height: 100%; position: absolute; inset: 0; object-fit: cover; }
        .contact-art-overlay { position: absolute; inset: 0; background: #09090970; }
        .contact-art > span { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%) rotate(-8deg); font-family: 'Barlow Condensed'; font-size: clamp(70px,9vw,125px); font-weight: 900; line-height: .75; text-align: center; color: white; }
        .red-dot { color: var(--accent); }
        .contact-art-corner { position: absolute; bottom: 20px; right: 20px; color: white; font-size: 8px; letter-spacing: 2px; }

        .footer { background: #080808; color: white; padding: 70px 7% 25px; }
        .footer-main { display: grid; grid-template-columns: 1.3fr repeat(3,.7fr) 1.3fr; gap: 35px; padding-bottom: 60px; }
        .footer-brand p, .footer-news p { color: #888; font-size: 10px; line-height: 1.8; margin-top: 20px; }
        .social-row { display: flex; gap: 8px; margin-top: 20px; }
        .social-row a { width: 30px; height: 30px; display: grid; place-items: center; border: 1px solid #333; color: #aaa; font-size: 10px; }
        .footer-column > strong, .footer-news > strong { display: block; font-size: 9px; letter-spacing: 1.5px; margin-bottom: 20px; }
        .footer-column a { display: block; color: #888; font-size: 10px; margin: 13px 0; }
        .footer-column a:hover { color: var(--accent); }
        .footer-news form { display: flex; border-bottom: 1px solid #555; }
        .footer-news input { width: 100%; border: 0; outline: 0; padding: 12px 0; background: transparent; color: white; font-size: 10px; }
        .footer-news button { background: transparent; border: 0; color: var(--accent); }
        .footer-news small { color: #777; font-size: 8px; display: block; margin-top: 12px; }
        .footer-bottom { display: flex; justify-content: space-between; gap: 20px; border-top: 1px solid #292929; padding-top: 22px; color: #777; font-size: 8px; letter-spacing: 1px; }
        .footer-bottom div { display: flex; gap: 20px; }
        .footer-bottom a:hover { color: white; }

        .toast {
            position: fixed;
            z-index: 100;
            bottom: 25px;
            right: 25px;
            background: var(--surface);
            border: 1px solid var(--accent);
            color: var(--text);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 11px;
            box-shadow: 0 15px 40px #0005;
            animation: rise .3s both;
        }

        .toast i { color: var(--accent); }
        .back-top {
            position: fixed;
            bottom: 25px;
            left: 25px;
            z-index: 40;
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--text);
            opacity: 0;
            pointer-events: none;
            transition: .2s;
        }

        .back-top.visible { opacity: 1; pointer-events: auto; }

        .reveal { opacity: 0; transform: translateY(25px); transition: opacity .7s, transform .7s; }
        .reveal.is-visible { opacity: 1; transform: translateY(0); }

        @media (max-width: 1050px) {
            .nav { gap: 16px; }
            .header { padding: 0 4%; }
            .section { padding: 85px 5%; }
            .builder-inner { gap: 40px; }
            .footer-main { grid-template-columns: repeat(3,1fr); }
            .footer-brand { grid-column: span 3; }
        }

        @media (max-width: 760px) {
            .announcement { font-size: 8px; }
            .header { height: 68px; }
            .nav {
                position: absolute;
                top: 68px;
                left: 0;
                right: 0;
                display: none;
                padding: 20px 6%;
                background: var(--surface);
                border-bottom: 1px solid var(--line);
                flex-direction: column;
                align-items: stretch;
                gap: 0;
            }
            .nav.nav-open { display: flex; }
            .nav a { padding: 15px 0; border-bottom: 1px solid var(--line); }
            .header-order { display: none; }
            .menu-toggle { display: grid; }
            .hero { min-height: 680px; height: auto; }
            .hero-content { width: 88%; padding: 90px 0 130px; }
            .hero h1 { font-size: clamp(70px,17vw,110px); }
            .hero-side-note, .hero-card { display: none; }
            .hero-bottom { bottom: 20px; }
            .hero-proof { margin-top: 35px; }
            .trust-strip { grid-template-columns: repeat(2,1fr); gap: 20px 0; padding: 25px 5%; }
            .trust-strip > div { padding: 5px 10px; }
            .trust-strip > div:nth-child(2) { border-right: 0; }
            .trust-strip > div:first-child { padding-left: 10px; }
            .section { padding: 75px 6%; }
            .section-heading { display: block; }
            .heading-aside { margin-top: 25px; }
            .section-heading h2 { font-size: clamp(55px,13vw,80px); }
            .category-grid { grid-template-columns: repeat(2,1fr); }
            .category-tile { padding: 14px; min-height: 95px; gap: 10px; }
            .category-tile strong { font-size: 11px; }
            .category-tile small { font-size: 7px; }
            .product-grid { grid-template-columns: repeat(2,1fr); }
            .product-image { height: 160px; }
            .product-info { padding: 13px; }
            .product-info h4 { font-size: 12px; }
            .product-price strong { font-size: 13px; }
            .catalog-note { align-items: flex-start; flex-wrap: wrap; line-height: 1.7; }
            .catalog-note a { margin-left: 0; }
            .builder-section { padding: 75px 6%; }
            .builder-inner { grid-template-columns: 1fr; gap: 45px; }
            .builder-copy h2 { font-size: 75px; }
            .builder-widget { padding: 20px; }
            .use-options { grid-template-columns: repeat(2,1fr); }
            .usecase-grid { grid-template-columns: 1fr; }
            .usecase-card { height: 430px; }
            .build-grid { grid-template-columns: 1fr; }
            .build-image { height: 250px; }
            .service-section { grid-template-columns: 1fr; }
            .service-image { min-height: 380px; }
            .service-content { padding: 70px 7%; }
            .service-content h2 { font-size: 75px; }
            .service-menu { grid-template-columns: 1fr; gap: 25px; }
            .service-menu-heading h2 { font-size: 65px; }
            .why-section { padding: 75px 6%; }
            .why-inner { grid-template-columns: 1fr; gap: 40px; }
            .why-copy h2 { font-size: 75px; }
            .why-visual { height: 350px; }
            .stats-row { grid-template-columns: repeat(2,1fr); gap: 20px 0; margin-top: 50px; }
            .stats-row > div { padding: 5px 10px; }
            .stats-row > div:nth-child(2) { border-right: 0; }
            .faq-section { grid-template-columns: 1fr; gap: 30px; }
            .faq-intro h2 { font-size: 65px; }
            .faq-item summary { gap: 12px; }
            .faq-item summary strong { font-size: 11px; }
            .contact-section { grid-template-columns: 1fr; }
            .contact-text { padding: 75px 7%; }
            .contact-text h2 { font-size: 75px; }
            .contact-art { min-height: 380px; }
            .footer { padding: 55px 6% 25px; }
            .footer-main { grid-template-columns: repeat(2,1fr); gap: 35px 20px; }
            .footer-brand { grid-column: span 2; }
            .footer-news { grid-column: span 2; }
            .footer-bottom { flex-direction: column; line-height: 1.8; }
        }

        @media (max-width: 420px) {
            .hero h1 { font-size: 66px; }
            .hero-actions { flex-direction: column; align-items: flex-start; }
            .hero-proof { flex-wrap: wrap; }
            .proof-divider { display: none; }
            .product-grid { gap: 8px; }
            .product-image { height: 135px; }
            .category-grid { gap: 7px; }
            .category-tile { min-height: 85px; }
            .category-icon i { width: 19px; }
            .footer-main { gap: 30px 15px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>
<div class="site-shell">

    <div class="announcement">
        <span class="announcement-pulse"></span>
        BUILT FOR YOUR NEXT LEVEL
        <span class="announcement-divider">/</span>
        Expert builds. Genuine parts. Real support.
        <a href="#services">Explore services <i data-lucide="arrow-up-right"></i></a>
    </div>

    <header class="header">
        <a class="brand" href="#top" aria-label="Forge PC home">
            <span class="brand-mark"><i data-lucide="zap"></i></span>
            <span class="brand-name">FORGE<span class="brand-light">PC</span><small>HARDWARE & SERVICES</small></span>
        </a>

        <nav class="nav" id="mainNav">
            <a href="#components">Components</a>
            <a href="#builder">PC Builder</a>
            <a href="#prebuilt">Prebuilt PCs</a>
            <a href="#services">Services</a>
            <a href="#why-forge">About</a>
        </nav>

        <div class="header-actions">
            <button class="icon-btn" id="themeToggle" aria-label="Toggle color theme">
                <i data-lucide="sun"></i>
            </button>
            <a class="header-order" href="{{ route('login') }}">Talk to an expert <i data-lucide="arrow-up-right"></i></a>
            <button class="icon-btn menu-toggle" id="menuToggle" aria-label="Toggle navigation">
                <i data-lucide="menu"></i>
            </button>
        </div>
    </header>

    <main id="top">

        <!-- HERO -->
        <section class="hero">
            <div class="hero-image"></div>
            <div class="hero-overlay"></div>
            <div class="hero-grid"></div>

            <div class="hero-content">
                <div class="eyebrow light-eyebrow"><span class="eyebrow-line"></span> YOUR BUILD. YOUR RULES. OUR EXPERTISE.</div>
                <h1>BUILT TO<br><span>OUTPERFORM.</span></h1>
                <p class="hero-copy">The right hardware changes everything. Find your parts, configure your perfect PC, or let our technicians bring your setup back to life.</p>

                <div class="hero-actions">
                    <a class="btn btn-primary" href="{{ route('login') }}">Build your PC <i data-lucide="arrow-up-right"></i></a>
                    <a class="btn btn-ghost" href="#components">Explore components <i data-lucide="arrow-down-right"></i></a>
                </div>

                <div class="hero-proof">
                    <div class="proof-avatars"><span>F</span><span>P</span><span>C</span></div>
                    <div><strong>Built around your needs.</strong><small>From first-time builders to power users.</small></div>
                    <div class="proof-divider"></div>
                    <div class="proof-rating"><i data-lucide="star"></i><strong>EXPERT-LED</strong></div>
                </div>
            </div>

            <div class="hero-side-note"><span>01 / 04</span><i></i> PERFORMANCE STARTS HERE</div>
            <div class="hero-bottom"><span>SCROLL TO EXPLORE</span><div class="scroll-line"></div><span>EST. FOR ENTHUSIASTS</span></div>

            <div class="hero-card">
                <span class="hero-card-label">THE FORGE STANDARD</span>
                <strong>NO GUESSWORK.<br>JUST GOOD BUILDS.</strong>
                <span class="hero-card-icon"><i data-lucide="cpu"></i></span>
            </div>
        </section>

        <!-- TRUST STRIP -->
        <section class="trust-strip">
            <div><i data-lucide="shield-check"></i><span><strong>GENUINE COMPONENTS</strong><small>Trusted hardware sources</small></span></div>
            <div><i data-lucide="wrench"></i><span><strong>EXPERT ASSEMBLY</strong><small>Built and tested by pros</small></span></div>
            <div><i data-lucide="truck"></i><span><strong>DELIVERY & PICKUP</strong><small>Convenient order options</small></span></div>
            <div><i data-lucide="headphones"></i><span><strong>AFTER-SALES SUPPORT</strong><small>Help beyond checkout</small></span></div>
        </section>

        <!-- COMPONENTS -->
        <section class="section components-section" id="components">
            <div class="section-heading reveal">
                <div>
                    <div class="eyebrow"><span class="eyebrow-line"></span> THE HARDWARE DEPARTMENT</div>
                    <h2>GOOD PARTS.<br><span>GREAT POSSIBILITIES.</span></h2>
                </div>
                <div class="heading-aside">
                    <p>Everything you need to build, upgrade, and get more out of your setup. Shop individual components with specs that make sense.</p>
                    <a class="text-link" href="#contact">Browse all components <i data-lucide="arrow-up-right"></i></a>
                </div>
            </div>

            <div class="category-grid reveal">
                @php
                    $categories = [
                        ['Processors','CPU / PROCESSING','cpu'],
                        ['Graphics cards','GPU / VISUALS','monitor'],
                        ['Motherboards','FOUNDATION / PLATFORM','circuit-board'],
                        ['Memory & storage','RAM / SSD / HDD','hard-drive'],
                        ['Power & cooling','PSU / THERMALS','fan'],
                        ['Peripherals','GEAR / ACCESSORIES','gamepad-2'],
                    ];
                @endphp

                @foreach($categories as $index => $category)
                    <a class="category-tile" href="#contact" onclick="event.preventDefault(); notify('{{ $category[0] }} catalog is coming soon.')">
                        <span class="category-icon"><i data-lucide="{{ $category[2] }}"></i></span>
                        <span><strong>{{ $category[0] }}</strong><small>{{ $category[1] }}</small></span>
                        <i class="category-arrow" data-lucide="arrow-up-right"></i>
                        <span class="category-index">{{ sprintf('%02d', $index + 1) }}</span>
                    </a>
                @endforeach
            </div>

            <div class="product-head reveal">
                <div><span class="eyebrow">HANDPICKED HARDWARE</span><h3>Featured components</h3></div>
                <a class="text-link" href="#contact">View catalog <i data-lucide="arrow-up-right"></i></a>
            </div>

            @php
                $products = [
                    ['GeForce RTX 4070 SUPER','GRAPHICS CARD','₱38,950','₱41,500','POPULAR','https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&w=900&q=85','12GB GDDR6X · PCIe 4.0'],
                    ['AMD Ryzen 7 7800X3D','PROCESSOR','₱22,995','','GAMING PICK','https://images.unsplash.com/photo-1555617981-dac3880eac6e?auto=format&fit=crop&w=900&q=85','8 Cores · 16 Threads · AM5'],
                    ['Forge Airflow MESH','PC CASE','₱3,850','','NEW ARRIVAL','https://images.unsplash.com/photo-1587202372634-32705e3bf49c?auto=format&fit=crop&w=1200&q=85','ATX · High airflow · 4 fans'],
                    ['32GB DDR5 6000MHz','MEMORY','₱5,490','','','https://images.unsplash.com/photo-1593640408182-31c70c8268f5?auto=format&fit=crop&w=1200&q=85','2 × 16GB · DDR5 · 6000MHz'],
                ];
            @endphp

            <div class="product-grid reveal">
                @foreach($products as $product)
                    <article class="product-card">
                        <div class="product-image">
                            <img src="{{ $product[5] }}" alt="{{ $product[0] }}" loading="lazy">
                            <span class="product-tag">{{ $product[4] ?: 'FOR YOUR BUILD' }}</span>
                            <button class="product-add" aria-label="View {{ $product[0] }}" onclick="notify('{{ $product[0] }} selected. Product catalog integration can be connected here.')">
                                <i data-lucide="arrow-up-right"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-type">{{ $product[1] }}</span>
                            <h4>{{ $product[0] }}</h4>
                            <p>{{ $product[6] }}</p>
                            <div class="product-price">
                                <strong>{{ $product[2] }}</strong>
                                @if($product[3]) <del>{{ $product[3] }}</del> @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="catalog-note">
                <i data-lucide="package"></i>
                <span>Looking for a specific part? Our team can help source components that fit your build.</span>
                <a href="#contact">Ask us <i data-lucide="arrow-right"></i></a>
            </div>
        </section>

        <!-- PC BUILDER -->
        <section class="builder-section" id="builder">
            <div class="builder-bg"></div>
            <div class="builder-inner">
                <div class="builder-copy reveal">
                    <div class="eyebrow light-eyebrow"><span class="eyebrow-line"></span> YOUR BUILD STARTS HERE</div>
                    <h2>DON'T JUST<br>BUY A PC.<br><span>BUILD YOURS.</span></h2>
                    <p>Not sure where to start? Tell us what you do and what you want to spend. We'll help you put together a balanced build, with compatibility checks along the way.</p>

                    <div class="builder-points">
                        <span><i data-lucide="check-circle-2"></i> Component compatibility guidance</span>
                        <span><i data-lucide="check-circle-2"></i> Budget-conscious recommendations</span>
                        <span><i data-lucide="check-circle-2"></i> Performance matched to your workload</span>
                    </div>

                    <a href="#contact" class="btn btn-primary">Open the PC builder <i data-lucide="arrow-up-right"></i></a>
                </div>

                <div class="builder-widget reveal">
                    <div class="widget-top">
                        <div><span class="widget-kicker">FORGE CONFIGURATOR / PREVIEW</span><h3>Find your build.</h3></div>
                        <span class="live-dot">GUIDED SETUP</span>
                    </div>

                    <div class="widget-field">
                        <label>01 — WHAT WILL YOU USE IT FOR?</label>
                        <div class="use-options">
                            <button class="use-option active" data-use="Gaming"><i data-lucide="gamepad-2"></i>Gaming</button>
                            <button class="use-option" data-use="Work"><i data-lucide="monitor"></i>Work</button>
                            <button class="use-option" data-use="Creative"><i data-lucide="sparkles"></i>Creative</button>
                            <button class="use-option" data-use="Study"><i data-lucide="clipboard-check"></i>Study</button>
                        </div>
                    </div>

                    <div class="widget-field">
                        <div class="budget-label">
                            <label>02 — YOUR TARGET BUDGET</label>
                            <strong id="budgetValue">₱50,000</strong>
                        </div>
                        <input id="budgetRange" aria-label="Target budget" type="range" min="20000" max="150000" step="5000" value="50000">
                        <div class="range-labels"><span>₱20,000</span><span>₱150,000+</span></div>
                    </div>

                    <div class="widget-result">
                        <div class="result-icon"><i data-lucide="cpu"></i></div>
                        <div>
                            <span>YOUR STARTING POINT</span>
                            <strong id="buildRecommendation">Balanced gaming build</strong>
                            <small>Recommended around <span id="budgetRecommendation">₱50,000</span></small>
                        </div>
                        <i data-lucide="arrow-up-right"></i>
                    </div>

                    <button class="widget-submit" onclick="notify('Your build request is ready to connect to the configurator.')">
                        Continue to configuration <i data-lucide="arrow-right"></i>
                    </button>
                    <p class="widget-disclaimer">Illustrative estimate only. Final component selection depends on current stock and compatibility.</p>
                </div>
            </div>
        </section>

        <!-- USE CASES -->
        <section class="section usecase-section">
            <div class="section-heading reveal">
                <div>
                    <div class="eyebrow"><span class="eyebrow-line"></span> BUILT AROUND YOUR WORKFLOW</div>
                    <h2>ONE SIZE DOESN'T<br><span>FIT EVERY SETUP.</span></h2>
                </div>
                <div class="heading-aside">
                    <p>A PC should work as hard as you do. Start with your workload and we'll help prioritize the components that matter.</p>
                </div>
            </div>

            <div class="usecase-grid reveal">
                <article class="usecase-card">
                    <img src="https://images.unsplash.com/photo-1593305841991-05c297ba4575?auto=format&fit=crop&w=1200&q=85" alt="Gaming PC setup" loading="lazy">
                    <div class="usecase-shade"></div>
                    <span class="usecase-number">01 / PLAY</span>
                    <div class="usecase-content">
                        <span>HIGH FPS · LOW LATENCY</span>
                        <h3>GAME<br>WITHOUT<br>LIMITS.</h3>
                        <p>Prioritize graphics, refresh rates, and smooth performance.</p>
                        <a href="#builder" class="circle-link" aria-label="Build a gaming PC"><i data-lucide="arrow-up-right"></i></a>
                    </div>
                </article>

                <article class="usecase-card">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=85" alt="Professional workstation" loading="lazy">
                    <div class="usecase-shade"></div>
                    <span class="usecase-number">02 / CREATE</span>
                    <div class="usecase-content">
                        <span>DESIGN · EDIT · DEVELOP</span>
                        <h3>MAKE<br>MORE<br>POSSIBLE.</h3>
                        <p>Power your creative tools and demanding workloads.</p>
                        <a href="#builder" class="circle-link" aria-label="Build a creator PC"><i data-lucide="arrow-up-right"></i></a>
                    </div>
                </article>

                <article class="usecase-card">
                    <img src="https://images.unsplash.com/photo-1593640408182-31c70c8268f5?auto=format&fit=crop&w=1200&q=85" alt="Study and productivity desktop" loading="lazy">
                    <div class="usecase-shade"></div>
                    <span class="usecase-number">03 / WORK</span>
                    <div class="usecase-content">
                        <span>STUDY · BUILD · MULTITASK</span>
                        <h3>FOCUS ON<br>WHAT'S<br>NEXT.</h3>
                        <p>A responsive, reliable setup for everyday productivity.</p>
                        <a href="#builder" class="circle-link" aria-label="Build a productivity PC"><i data-lucide="arrow-up-right"></i></a>
                    </div>
                </article>
            </div>
        </section>

        <!-- PREBUILT PCS -->
        <section class="section prebuilt-section" id="prebuilt">
            <div class="section-heading reveal">
                <div>
                    <div class="eyebrow"><span class="eyebrow-line"></span> READY WHEN YOU ARE</div>
                    <h2>LESS CONFIGURING.<br><span>MORE DOING.</span></h2>
                </div>
                <div class="heading-aside">
                    <p>Want a shortcut to a great setup? Explore build concepts assembled around real-world needs. Every system can be reviewed and customized.</p>
                    <a href="#contact" class="text-link">Find your prebuilt PC <i data-lucide="arrow-up-right"></i></a>
                </div>
            </div>

            @php
                $builds = [
                    ['THE STARTER','STUDY · EVERYDAY · OFFICE','₱24,990','A dependable everyday machine for school, work, and daily multitasking.','https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=85',['Ryzen 5 class CPU','16GB memory','1TB NVMe SSD']],
                    ['THE COMPETITOR','1080P · HIGH FPS · GAMING','₱49,990','Fast, responsive gaming with room to stream, create, and do more.','https://images.unsplash.com/photo-1593305841991-05c297ba4575?auto=format&fit=crop&w=1200&q=85',['Ryzen 5 / Core i5','RTX 4060 class GPU','32GB memory']],
                    ['THE CREATOR','EDITING · 3D · DEVELOPMENT','₱79,990','More cores, more memory, and GPU power for demanding creative work.','https://images.unsplash.com/photo-1593640408182-31c70c8268f5?auto=format&fit=crop&w=1200&q=85',['Ryzen 7 / Core i7','RTX 4070 class GPU','32GB–64GB memory']],
                ];
            @endphp

            <div class="build-grid reveal">
                @foreach($builds as $index => $build)
                    <article class="build-card {{ $index === 1 ? 'selected' : '' }}">
                        <div class="build-image">
                            <img src="{{ $build[4] }}" alt="{{ $build[0] }}" loading="lazy">
                            <span class="build-number">{{ sprintf('%02d', $index + 1) }}</span>
                            <span class="build-label">BUILD CONCEPT</span>
                        </div>
                        <div class="build-content">
                            <span class="build-use">{{ $build[1] }}</span>
                            <h3>{{ $build[0] }}</h3>
                            <p>{{ $build[3] }}</p>
                            <ul>
                                @foreach($build[5] as $spec)
                                    <li><i data-lucide="check"></i>{{ $spec }}</li>
                                @endforeach
                            </ul>
                            <div class="build-bottom">
                                <strong>FROM {{ $build[2] }}</strong>
                                <button onclick="notify('{{ $build[0] }} selected. Connect this action to the prebuilt product detail page.')">Explore build <i data-lucide="arrow-up-right"></i></button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <p class="fine-print">Build examples are starting points, not fixed quotations. Component models, pricing, and availability are subject to confirmation.</p>
        </section>

        <!-- TECHNICAL SERVICES -->
        <section class="service-section" id="services">
            <div class="service-image">
                <img src="https://images.unsplash.com/photo-1581092921461-eab62e97a780?auto=format&fit=crop&w=1200&q=85" alt="Technician working on computer hardware" loading="lazy">
                <div class="service-image-label"><i data-lucide="wrench"></i><span>TECHNICAL CARE<br><strong>DONE RIGHT.</strong></span></div>
            </div>

            <div class="service-content reveal">
                <div class="eyebrow light-eyebrow"><span class="eyebrow-line"></span> WHEN TECH GOES WRONG</div>
                <h2>WE FIX<br>MORE THAN<br><span>COMPUTERS.</span></h2>
                <p>Get your machine checked by people who know their hardware. Tell us what's happening, submit a quick pre-assessment, and book a time that works for you.</p>

                <div class="service-steps">
                    <div><span>01</span><div><strong>Tell us what's wrong</strong><small>Describe the symptoms and your device.</small></div></div>
                    <div><span>02</span><div><strong>Get an initial assessment</strong><small>Our team reviews your request before the visit.</small></div></div>
                    <div><span>03</span><div><strong>Book your service</strong><small>Choose an available slot and track progress.</small></div></div>
                </div>

                <a class="btn btn-primary" href="#contact">Book a diagnostic <i data-lucide="arrow-up-right"></i></a>
            </div>
        </section>

        <!-- SERVICE LIST -->
        <section class="service-menu section">
            <div class="service-menu-heading reveal">
                <div class="eyebrow"><span class="eyebrow-line"></span> SUPPORT THAT GOES FURTHER</div>
                <h2>FROM QUICK FIXES<br>TO <span>FULL REVIVALS.</span></h2>
            </div>

            @php
                $services = [
                    ['PC diagnostics','Find the cause before replacing parts.','search'],
                    ['Hardware repair','Component-level checks and replacements.','wrench'],
                    ['PC assembly','Careful assembly, cable management, and testing.','cpu'],
                    ['Cleaning & maintenance','Dust removal, thermal care, and preventive checks.','fan'],
                    ['Upgrades & optimization','Give your existing setup a meaningful upgrade.','gauge'],
                ];
            @endphp

            <div class="service-list reveal">
                @foreach($services as $index => $service)
                    <a href="#contact" onclick="event.preventDefault(); notify('{{ $service[0] }} service selected.')">
                        <span class="service-list-icon"><i data-lucide="{{ $service[2] }}"></i></span>
                        <span class="service-list-text"><strong>{{ $service[0] }}</strong><small>{{ $service[1] }}</small></span>
                        <span class="service-list-num">{{ sprintf('%02d', $index + 1) }}</span>
                        <i class="service-list-arrow" data-lucide="arrow-up-right"></i>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- WHY FORGE -->
        <section class="why-section" id="why-forge">
            <div class="why-inner">
                <div class="why-copy reveal">
                    <div class="eyebrow light-eyebrow"><span class="eyebrow-line"></span> THE FORGE DIFFERENCE</div>
                    <h2>HARDWARE IS<br>PERSONAL.<br><span>SO IS OUR<br>APPROACH.</span></h2>
                    <p>We believe a good PC isn't about buying the most expensive parts. It's about choosing the right parts for what you actually need — and having a team you can count on after the purchase.</p>
                    <a href="#contact" class="btn btn-outline-light">Get to know us <i data-lucide="arrow-up-right"></i></a>
                </div>

                <div class="why-visual reveal">
                    <img src="https://images.unsplash.com/photo-1587202372634-32705e3bf49c?auto=format&fit=crop&w=1200&q=85" alt="Custom-built desktop PC" loading="lazy">
                    <div class="why-stamp"><span>BUILT WITH</span><strong>INTENTION.</strong><span>BACKED BY EXPERTISE.</span></div>
                    <div class="why-caption"><span>01 — THE RIGHT BUILD</span><span>PERFORMANCE WITH PURPOSE</span></div>
                </div>
            </div>

            <div class="stats-row reveal">
                <div><strong>01</strong><span>ONE-STOP<br>HARDWARE DESTINATION</span></div>
                <div><strong>360°</strong><span>BUILD TO<br>AFTER-SALES SUPPORT</span></div>
                <div><strong>100%</strong><span>BUILT AROUND<br>YOUR NEEDS</span></div>
                <div><strong>∞</strong><span>ROOM TO<br>UPGRADE</span></div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="faq-section section" id="faq">
            <div class="faq-intro reveal">
                <div class="eyebrow"><span class="eyebrow-line"></span> GOOD TO KNOW</div>
                <h2>QUESTIONS?<br><span>WE'VE GOT YOU.</span></h2>
                <p>First build or fifth upgrade, it's okay to ask. Here's a quick start.</p>
                <a class="text-link" href="#contact">Talk to our team <i data-lucide="arrow-up-right"></i></a>
            </div>

            @php
                $faqs = [
                    ['Can you help me choose parts within my budget?','Absolutely. Tell us your budget, intended use, and any must-have applications. We can suggest a balanced starting configuration.'],
                    ['How do I know if my selected parts are compatible?','The PC builder is designed to flag common compatibility issues such as CPU socket, memory generation, case clearance, and power requirements. Final builds should still be reviewed before purchase.'],
                    ['Can I buy individual components without building a PC?','Yes. The store is designed for individual component purchases as well as complete PC builds and prebuilt systems.'],
                    ['Can you diagnose my PC before I visit?','You can submit your device details and symptoms through a pre-assessment request. A technician can review the information and advise on the next step.'],
                    ['Are repair prices final after pre-assessment?','Not necessarily. Remote pre-assessment is preliminary. The final quotation may change after physical inspection, and additional work should require your approval.'],
                ];
            @endphp

            <div class="faq-list reveal">
                @foreach($faqs as $index => $faq)
                    <details class="faq-item">
                        <summary>
                            <span class="faq-num">{{ sprintf('%02d', $index + 1) }}</span>
                            <strong>{{ $faq[0] }}</strong>
                            <span class="faq-plus"><i data-lucide="plus"></i></span>
                        </summary>
                        <p>{{ $faq[1] }}</p>
                    </details>
                @endforeach
            </div>
        </section>

        <!-- CONTACT -->
        <section class="contact-section" id="contact">
            <div class="contact-text">
                <div class="eyebrow light-eyebrow"><span class="eyebrow-line"></span> YOUR NEXT MOVE STARTS HERE</div>
                <h2>LET'S MAKE<br>YOUR NEXT PC<br><span>HAPPEN.</span></h2>
                <p>Tell us what you're building, what needs fixing, or what you want to achieve. We'll help you figure out the right next step.</p>
                <div class="contact-actions">
                    <a href="mailto:hello@yourdomain.com" class="btn btn-primary">Get in touch <i data-lucide="arrow-up-right"></i></a>
                    <a href="#builder" class="contact-secondary">Start with the PC builder <i data-lucide="arrow-right"></i></a>
                </div>
            </div>

            <div class="contact-art">
                <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&w=1200&q=85" alt="Close-up of computer graphics hardware" loading="lazy">
                <div class="contact-art-overlay"></div>
                <span>MAKE IT<br>YOURS<span class="red-dot">.</span></span>
                <div class="contact-art-corner">FORGE PC / HARDWARE & SERVICES</div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-main">
            <div class="footer-brand">
                <a class="brand" href="#top">
                    <span class="brand-mark"><i data-lucide="zap"></i></span>
                    <span class="brand-name">FORGE<span class="brand-light">PC</span><small>HARDWARE & SERVICES</small></span>
                </a>
                <p>Build smarter. Buy confidently.<br>Get expert support.</p>
                <div class="social-row">
                    <a href="#contact" aria-label="Facebook">f</a>
                    <a href="#contact" aria-label="Instagram">ig</a>
                    <a href="#contact" aria-label="TikTok">tk</a>
                </div>
            </div>

            <div class="footer-column">
                <strong>SHOP</strong>
                <a href="#components">PC components</a>
                <a href="#prebuilt">Prebuilt PCs</a>
                <a href="#builder">Custom PC builder</a>
                <a href="#components">Accessories</a>
            </div>

            <div class="footer-column">
                <strong>SERVICES</strong>
                <a href="#services">Diagnostics</a>
                <a href="#services">Repairs</a>
                <a href="#services">PC assembly</a>
                <a href="#services">Maintenance</a>
            </div>

            <div class="footer-column">
                <strong>SUPPORT</strong>
                <a href="#contact">Contact us</a>
                <a href="#faq">FAQs</a>
                <a href="#contact">Warranty information</a>
                <a href="#contact">Order assistance</a>
            </div>

            <div class="footer-news">
                <strong>LET'S KEEP IN TOUCH.</strong>
                <p>Hardware drops, build ideas, and updates from the shop.</p>
                <form id="newsletterForm">
                    <input type="email" placeholder="Your email address" aria-label="Your email address" required>
                    <button aria-label="Subscribe" type="submit"><i data-lucide="arrow-up-right"></i></button>
                </form>
                <small>No spam. Just useful updates.</small>
            </div>
        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} FORGE PC. ALL RIGHTS RESERVED.</span>
            <span>BUILT FOR WHAT'S NEXT <span class="red-dot">●</span></span>
            <div><a href="#contact">Privacy</a><a href="#contact">Terms</a></div>
        </div>
    </footer>

    <div class="toast" id="toast" style="display:none;">
        <i data-lucide="check-circle-2"></i>
        <span id="toastMessage"></span>
    </div>

    <button class="back-top" id="backTop" aria-label="Back to top">
        <i data-lucide="arrow-up-right"></i>
    </button>

</div>

<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Theme toggle
    const themeToggle = document.getElementById('themeToggle');
    const root = document.documentElement;

    const savedTheme = localStorage.getItem('forge-theme') || 'dark';
    root.dataset.theme = savedTheme;

    function updateThemeIcon() {
        themeToggle.innerHTML = root.dataset.theme === 'dark'
            ? '<i data-lucide="sun"></i>'
            : '<i data-lucide="moon"></i>';

        lucide.createIcons();
    }

    updateThemeIcon();

    themeToggle.addEventListener('click', () => {
        const nextTheme = root.dataset.theme === 'dark' ? 'light' : 'dark';
        root.dataset.theme = nextTheme;
        localStorage.setItem('forge-theme', nextTheme);
        updateThemeIcon();
    });

    // Mobile navigation
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');

    menuToggle.addEventListener('click', () => {
        mainNav.classList.toggle('nav-open');

        menuToggle.innerHTML = mainNav.classList.contains('nav-open')
            ? '<i data-lucide="x"></i>'
            : '<i data-lucide="menu"></i>';

        lucide.createIcons();
    });

    mainNav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            mainNav.classList.remove('nav-open');
            menuToggle.innerHTML = '<i data-lucide="menu"></i>';
            lucide.createIcons();
        });
    });

    // Toast notifications
    let toastTimeout;

    function notify(message) {
        const toast = document.getElementById('toast');
        document.getElementById('toastMessage').textContent = message;

        toast.style.display = 'flex';

        clearTimeout(toastTimeout);

        toastTimeout = setTimeout(() => {
            toast.style.display = 'none';
        }, 2600);
    }

    // PC builder preview
    let activeUse = 'Gaming';

    const useButtons = document.querySelectorAll('.use-option');
    const budgetRange = document.getElementById('budgetRange');
    const budgetValue = document.getElementById('budgetValue');
    const budgetRecommendation = document.getElementById('budgetRecommendation');
    const buildRecommendation = document.getElementById('buildRecommendation');

    const recommendations = {
        Gaming: 'Balanced gaming build',
        Work: 'Productivity workstation',
        Creative: 'Creator-focused workstation',
        Study: 'Everyday study PC'
    };

    useButtons.forEach(button => {
        button.addEventListener('click', () => {
            useButtons.forEach(item => item.classList.remove('active'));
            button.classList.add('active');

            activeUse = button.dataset.use;
            buildRecommendation.textContent = recommendations[activeUse];
        });
    });

    function formatPeso(value) {
        return '₱' + Number(value).toLocaleString('en-PH');
    }

    budgetRange.addEventListener('input', () => {
        const formatted = formatPeso(budgetRange.value);
        budgetValue.textContent = formatted;
        budgetRecommendation.textContent = formatted;
    });

    // Newsletter placeholder
    document.getElementById('newsletterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        notify('Newsletter form is ready to connect to your email service.');
        this.reset();
    });

    // Scroll reveal animations
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.reveal').forEach(element => {
        observer.observe(element);
    });

    // Back to top
    const backTop = document.getElementById('backTop');

    window.addEventListener('scroll', () => {
        backTop.classList.toggle('visible', window.scrollY > 500);
    });

    backTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
</body>
</html>