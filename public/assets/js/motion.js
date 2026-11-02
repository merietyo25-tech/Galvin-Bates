/* ================================================================
   Accueil v3 — GSAP (+ ScrollTrigger) et Three.js
   Thème : financement / prêts.
   - Hero : piles de pièces d'euro, barres de croissance et courbe de
     tendance (Three.js), icônes des 6 types de prêt en orbite
     (immobilier, auto, entreprise, études, vélo, personnel)
   - Titre révélé ligne par ligne, compteurs, boutons magnétiques (GSAP)
   - Scroll : la scène s'éloigne, révélations de sections, ligne des étapes
   Désactivé si "réduire les animations" ; si GSAP échoue, WOW.js prend le
   relais (voir layouts/app.blade.php).
================================================================ */
(function () {
    'use strict';

    if (!window.gsap) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    window.__gsapMotion = true;
    gsap.registerPlugin(window.ScrollTrigger);

    var desktop = window.matchMedia('(min-width: 992px)').matches;
    var canHover = window.matchMedia('(hover: hover)').matches;
    var hx = document.getElementById('hx');

    /* ── 1. Entrée du hero ─────────────────────────────────────── */
    if (hx) {
        gsap.set('.hx-line > span', { yPercent: 115 });
        var tl = gsap.timeline({ defaults: { ease: 'power4.out' }, delay: .15 });
        tl.from('.hx__chip', { y: 18, autoAlpha: 0, duration: .7 })
          .to('.hx-line > span', { yPercent: 0, duration: 1.2, stagger: .14 }, '-=.35')
          .from('.hx__lead', { y: 24, autoAlpha: 0, duration: .8 }, '-=.8')
          .from('.hx__pills li', { y: 16, autoAlpha: 0, duration: .55, stagger: .08 }, '-=.6')
          .from('.hx-btn', { y: 22, autoAlpha: 0, scale: .94, duration: .7, stagger: .12, ease: 'back.out(1.6)' }, '-=.5')
          .from('.hx-photo', { yPercent: 8, autoAlpha: 0, scale: .94, duration: 1.1, ease: 'power3.out' }, .3)
          .from('.hx-phone', { y: 90, autoAlpha: 0, rotate: -6, duration: 1.1, ease: 'back.out(1.4)' }, .7)
          .from('.hx-chip', { scale: .6, autoAlpha: 0, duration: .7, stagger: .18, ease: 'back.out(2)' }, 1.2)
          .from('.hx__trust', { yPercent: 100, duration: .9 }, '-=.6')
          .from('.hx__trust-item', { y: 14, autoAlpha: 0, duration: .5, stagger: .1 }, '-=.5');

        // Flottement doux de la maquette et des pastilles
        document.querySelectorAll('[data-float]').forEach(function (el, i) {
            gsap.to(el, { y: '+=' + el.getAttribute('data-float'), duration: 2.6 + i * .5, ease: 'sine.inOut', yoyo: true, repeat: -1, delay: 2.5 + i * .3 });
        });
        // Parallaxe souris sur le visuel
        var vis = document.querySelector('.hx__visual');
        if (vis && desktop && canHover) {
            var vx = gsap.quickTo(vis, 'x', { duration: .9, ease: 'power3' }), vy = gsap.quickTo(vis, 'y', { duration: .9, ease: 'power3' });
            hx.addEventListener('pointermove', function (e) { vx((e.clientX / innerWidth - .5) * -18); vy((e.clientY / innerHeight - .5) * -12); });
        }

        // Compteurs des chiffres clés
        var fmt = new Intl.NumberFormat('fr-FR');
        document.querySelectorAll('[data-count]').forEach(function (el) {
            var o = { v: 0 }, suffix = el.getAttribute('data-suffix') || '';
            gsap.to(o, { v: +el.getAttribute('data-count'), duration: 2.4, delay: 1.4, ease: 'power3.out',
                onUpdate: function () { el.textContent = fmt.format(Math.round(o.v)) + suffix; } });
        });

        // Boutons magnétiques (desktop avec souris)
        if (desktop && canHover) {
            document.querySelectorAll('[data-magnetic]').forEach(function (btn) {
                var qx = gsap.quickTo(btn, 'x', { duration: .5, ease: 'power3' });
                var qy = gsap.quickTo(btn, 'y', { duration: .5, ease: 'power3' });
                btn.addEventListener('pointermove', function (e) {
                    var r = btn.getBoundingClientRect();
                    qx((e.clientX - r.left - r.width / 2) * .25);
                    qy((e.clientY - r.top - r.height / 2) * .35);
                });
                btn.addEventListener('pointerleave', function () { qx(0); qy(0); });
            });
        }

        // Au scroll : le texte monte et s'estompe
        gsap.to('.hx__copy', {
            yPercent: -14, autoAlpha: .15, ease: 'none',
            scrollTrigger: { trigger: hx, start: 'top top', end: '80% top', scrub: true }
        });
    }

    /* ── 2. Sections ───────────────────────────────────────────── */
    gsap.utils.toArray('.wow').forEach(function (el) {
        var cls = el.className, from = { autoAlpha: 0, duration: 1, ease: 'power3.out' };
        if (/fadeInLeft/.test(cls))       from.x = -60;
        else if (/fadeInRight/.test(cls)) from.x = 60;
        else                              from.y = 46;
        from.delay = (parseFloat(el.getAttribute('data-wow-delay')) || 0) / 1000;
        gsap.from(el, Object.assign({ scrollTrigger: { trigger: el, start: 'top 88%', once: true } }, from));
        el.style.visibility = 'visible';
    });

    gsap.utils.toArray('.section-title').forEach(function (el) {
        gsap.from(el, { y: 30, autoAlpha: 0, duration: .9, ease: 'power3.out',
            scrollTrigger: { trigger: el, start: 'top 90%', once: true } });
    });

    gsap.from('.service-nav-strip__item', {
        y: 26, autoAlpha: 0, duration: .6, stagger: .07, ease: 'power2.out',
        scrollTrigger: { trigger: '.service-nav-strip', start: 'top 95%', once: true }
    });

    // Cartes services : inclinaison 3D qui suit la souris
    if (desktop && canHover) {
        document.querySelectorAll('.is-home .service-card').forEach(function (card) {
            var rx = gsap.quickTo(card, 'rotationX', { duration: .5, ease: 'power3' });
            var ry = gsap.quickTo(card, 'rotationY', { duration: .5, ease: 'power3' });
            gsap.set(card, { transformPerspective: 900 });
            card.addEventListener('pointermove', function (e) {
                var r = card.getBoundingClientRect();
                ry(((e.clientX - r.left) / r.width - .5) * 10);
                rx(-((e.clientY - r.top) / r.height - .5) * 10);
            });
            card.addEventListener('pointerleave', function () { rx(0); ry(0); });
        });
    }

    // Étapes : la ligne se dessine pendant le scroll
    var line = document.querySelector('.steps-line > i');
    if (line) {
        gsap.to(line, { scaleX: 1, ease: 'none',
            scrollTrigger: { trigger: '.steps-wrap', start: 'top 75%', end: 'bottom 65%', scrub: .6 } });
    }

    // Barre de progression de lecture
    var bar = document.createElement('div');
    bar.setAttribute('aria-hidden', 'true');
    bar.style.cssText = 'position:fixed;top:0;left:0;height:3px;width:100%;transform-origin:0 50%;transform:scaleX(0);' +
        'background:linear-gradient(90deg,#C6A15B,#DCBE87);z-index:9999;pointer-events:none';
    document.body.appendChild(bar);
    gsap.to(bar, { scaleX: 1, ease: 'none',
        scrollTrigger: { trigger: document.documentElement, start: 'top top', end: 'bottom bottom', scrub: .3 } });

    /* ── 3. Scène 3D « financement » ───────────────────────────── */
    var canvas = document.getElementById('hx-canvas');
    if (!hx || !canvas || !window.THREE) return;

    var renderer;
    try {
        renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
    } catch (e) { return; }                       // pas de WebGL : le hero reste en dégradé
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 1.75));
    renderer.setClearColor(0x000000, 0);

    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(40, 1, .1, 100);
    camera.position.set(0, 1.2, 10);

    scene.add(new THREE.AmbientLight(0xfff1d6, .75));
    var key = new THREE.DirectionalLight(0xffffff, 1.15); key.position.set(3, 6, 5); scene.add(key);
    var rim = new THREE.PointLight(0xDCBE87, 2.2, 22); rim.position.set(-5, 1, 3); scene.add(rim);

    var fin = new THREE.Group();                  // toute la scène financière
    scene.add(fin);

    // Texture d'une pièce (face avec €)
    function coinFace() {
        var c = document.createElement('canvas'); c.width = c.height = 256;
        var g = c.getContext('2d');
        var grd = g.createRadialGradient(100, 90, 20, 128, 128, 128);
        grd.addColorStop(0, '#F5EDDD'); grd.addColorStop(.6, '#DCBE87'); grd.addColorStop(1, '#9A7736');
        g.fillStyle = grd; g.beginPath(); g.arc(128, 128, 128, 0, 7); g.fill();
        g.strokeStyle = 'rgba(14,59,46,.35)'; g.lineWidth = 8; g.beginPath(); g.arc(128, 128, 108, 0, 7); g.stroke();
        g.fillStyle = '#0E3B2E'; g.font = '700 150px "Fraunces", Georgia, serif';
        g.textAlign = 'center'; g.textBaseline = 'middle'; g.fillText('€', 128, 138);
        var t = new THREE.CanvasTexture(c); t.anisotropy = 4; return t;
    }
    var faceTex = coinFace();
    var coinGeo = new THREE.CylinderGeometry(.62, .62, .14, 56);
    var matSide = new THREE.MeshStandardMaterial({ color: 0xC6A15B, metalness: .75, roughness: .35 });
    var matFace = new THREE.MeshStandardMaterial({ map: faceTex, metalness: .55, roughness: .3 });
    var coinMats = [matSide, matFace, matFace];

    // Trois piles de pièces de hauteurs croissantes
    var stacks = [{ x: -1.35, n: 5 }, { x: 0, n: 8 }, { x: 1.35, n: 12 }], coins = [];
    stacks.forEach(function (st) {
        for (var i = 0; i < st.n; i++) {
            var m = new THREE.Mesh(coinGeo, coinMats);
            m.position.set(st.x + (Math.random() - .5) * .05, i * .165, (Math.random() - .5) * .05);
            m.rotation.y = Math.random() * 6.28;
            m.userData.y = m.position.y;
            fin.add(m); coins.push(m);
        }
    });

    // Barres de croissance (verre bleu) derrière les piles + courbe de tendance
    var barH = [.9, 1.3, 1.7, 2.2, 2.8, 3.5], bars = [], tops = [];
    barH.forEach(function (h, i) {
        var g = new THREE.BoxGeometry(.5, h, .5); g.translate(0, h / 2, 0);
        var b = new THREE.Mesh(g, new THREE.MeshStandardMaterial({
            color: 0x1C6B51, emissive: 0x14503D, emissiveIntensity: .5, transparent: true, opacity: .32, metalness: .2, roughness: .3 }));
        b.position.set(-2.6 + i * .95, 0, -1.6);
        fin.add(b); bars.push(b);
        tops.push(new THREE.Vector3(b.position.x, h + .25, b.position.z));
    });
    var trendCurve = new THREE.CatmullRomCurve3(tops);
    var trend = new THREE.Line(new THREE.BufferGeometry().setFromPoints(trendCurve.getPoints(60)),
        new THREE.LineBasicMaterial({ color: 0xDCBE87, transparent: true, opacity: .9 }));
    fin.add(trend);
    var arrow = new THREE.Mesh(new THREE.ConeGeometry(.14, .38, 16), new THREE.MeshBasicMaterial({ color: 0xDCBE87 }));
    arrow.position.copy(tops[tops.length - 1]).add(new THREE.Vector3(.12, .2, 0));
    arrow.rotation.z = -Math.PI / 3.4;
    fin.add(arrow);

    // Socle lumineux
    var floor = new THREE.Mesh(new THREE.RingGeometry(2.2, 3.4, 80),
        new THREE.MeshBasicMaterial({ color: 0x1C6B51, transparent: true, opacity: .16, side: THREE.DoubleSide }));
    floor.rotation.x = -Math.PI / 2; floor.position.set(0, -.08, -.4); fin.add(floor);
    var floor2 = floor.clone(); floor2.scale.setScalar(1.4); floor2.material = floor.material.clone(); floor2.material.opacity = .07; fin.add(floor2);

    // Anneau de remboursement (arc qui se remplit)
    var ringMat = new THREE.MeshBasicMaterial({ color: 0xC6A15B, transparent: true, opacity: .8 });
    var ring = new THREE.Mesh(new THREE.TorusGeometry(3.2, .03, 8, 140, Math.PI * 2 * .72), ringMat);
    ring.rotation.x = -Math.PI / 2.15; ring.position.set(0, 1.2, -.4); fin.add(ring);

    // Icônes des 6 types de prêt en orbite (glyphes Font Awesome dessinés sur canvas)
    var orbit = new THREE.Group(); orbit.position.set(0, 1.6, -.4); fin.add(orbit);
    var icons = ['', '', '', '', '', ''];   // maison, auto, mallette, études, vélo, personnel
    function badge(glyph) {
        var c = document.createElement('canvas'); c.width = c.height = 160;
        var g = c.getContext('2d');
        g.fillStyle = 'rgba(8,42,32,.88)'; g.beginPath(); g.arc(80, 80, 74, 0, 7); g.fill();
        g.strokeStyle = 'rgba(220,190,135,.85)'; g.lineWidth = 5; g.stroke();
        g.fillStyle = '#F5EDDD'; g.font = '900 64px "Font Awesome 5 Free"';
        g.textAlign = 'center'; g.textBaseline = 'middle'; g.fillText(glyph, 80, 84);
        return new THREE.CanvasTexture(c);
    }
    var sprites = [];
    function buildBadges() {
        icons.forEach(function (gl, i) {
            var s = new THREE.Sprite(new THREE.SpriteMaterial({ map: badge(gl), transparent: true, depthWrite: false }));
            s.scale.setScalar(.78); s.userData.a = i / icons.length * Math.PI * 2;
            orbit.add(s); sprites.push(s);
            gsap.from(s.scale, { x: 0, y: 0, duration: .8, delay: 1.4 + i * .1, ease: 'back.out(2)' });
        });
    }
    if (document.fonts && document.fonts.load) {
        document.fonts.load('900 64px "Font Awesome 5 Free"').then(buildBadges, buildBadges);
    } else { buildBadges(); }

    // Particules : pièces/étincelles qui montent doucement
    var PC = desktop ? 70 : 30, pp = new Float32Array(PC * 3), pv = [];
    for (var p = 0; p < PC; p++) {
        pp[p * 3] = (Math.random() - .5) * 9; pp[p * 3 + 1] = Math.random() * 5; pp[p * 3 + 2] = (Math.random() - .5) * 5;
        pv.push(.12 + Math.random() * .25);
    }
    var pGeo = new THREE.BufferGeometry();
    pGeo.setAttribute('position', new THREE.BufferAttribute(pp, 3));
    fin.add(new THREE.Points(pGeo, new THREE.PointsMaterial({ color: 0xDCBE87, size: .06, transparent: true, opacity: .8, depthWrite: false, blending: THREE.AdditiveBlending })));

    // Animation d'entrée : les pièces tombent en cascade, les barres poussent
    coins.forEach(function (c, i) {
        c.position.y = c.userData.y + 6; c.scale.setScalar(.01);
        gsap.to(c.position, { y: c.userData.y, duration: .9, delay: .6 + i * .045, ease: 'bounce.out' });
        gsap.to(c.scale, { x: 1, y: 1, z: 1, duration: .4, delay: .6 + i * .045 });
    });
    bars.forEach(function (b, i) {
        b.scale.y = .001;
        gsap.to(b.scale, { y: 1, duration: 1.3, delay: .8 + i * .12, ease: 'elastic.out(1,.6)' });
    });
    trend.material.opacity = 0; arrow.visible = false;
    gsap.to(trend.material, { opacity: .9, duration: 1, delay: 1.9 });
    gsap.delayedCall(2.1, function () { arrow.visible = true; });
    gsap.from(ring.rotation, { z: -Math.PI * 1.4, duration: 2.4, delay: .5, ease: 'power3.out' });

    // Placement : à droite sur desktop, derrière le texte et plus petit sur mobile
    var base = { x: 0, y: 0, s: 1 };
    var sc = { x: 0, y: 0, s: 1, k: 0 };
    function apply() { fin.position.set(sc.x, sc.y, 0); fin.scale.setScalar(sc.s); }
    function layout() {
        var w = hx.clientWidth, h = hx.clientHeight;
        renderer.setSize(w, h, false);
        camera.aspect = w / h; camera.updateProjectionMatrix();
        var vh = 2 * Math.tan(camera.fov * Math.PI / 360) * camera.position.z, vw = vh * camera.aspect;
        if (w >= 992) { base.x = vw * .27; base.y = -vh * .2; base.s = Math.min(.95, vh / 8.2); }
        else          { base.x = 0; base.s = Math.min(.8, vw / 4.6); base.y = (h / 2 - (h - (w < 576 ? 365 : 285) - base.s * 60)) / h * vh; }
        sc.x = base.x; sc.y = base.y; sc.s = base.s; apply();
    }
    layout();
    window.addEventListener('resize', layout, { passive: true });

    // Au scroll : la scène glisse vers le haut/droite et rapetisse
    gsap.to(sc, {
        x: function () { return base.x + 1.2; }, y: function () { return base.y + 1.8; }, s: function () { return base.s * .6; }, k: 1,
        ease: 'none', onUpdate: apply,
        scrollTrigger: { trigger: hx, start: 'top top', end: 'bottom top', scrub: true, invalidateOnRefresh: true }
    });

    var mx = 0, my = 0, tx = 0, ty = 0;
    window.addEventListener('pointermove', function (e) {
        mx = e.clientX / window.innerWidth - .5; my = e.clientY / window.innerHeight - .5;
    }, { passive: true });

    var visible = true, t0 = 0;
    new IntersectionObserver(function (e) { visible = e[0].isIntersecting; }).observe(hx);

    gsap.ticker.add(function (time, dtms) {
        if (!visible || document.hidden) return;
        var dt = Math.min(dtms / 1000, .05); t0 += dt;
        tx += (mx - tx) * .05; ty += (my - ty) * .05;

        fin.rotation.y = Math.sin(t0 * .35) * .38 + tx * .5;      // les € restent lisibles
        fin.rotation.x = ty * .12;
        coins.forEach(function (c, i) { c.rotation.y += dt * (.25 + (i % 3) * .06); });
        ring.rotation.z += dt * .12;
        floor.rotation.z += dt * .05;

        sprites.forEach(function (s) {
            var a = s.userData.a + t0 * .28;
            s.position.set(Math.cos(a) * 2.8, Math.sin(a * 1.6) * .3, Math.sin(a) * 1.2);
        });

        var pos = pGeo.attributes.position.array;
        for (var i = 0; i < PC; i++) {
            pos[i * 3 + 1] += dt * pv[i];
            if (pos[i * 3 + 1] > 5.5) pos[i * 3 + 1] = 0;
        }
        pGeo.attributes.position.needsUpdate = true;

        renderer.render(scene, camera);
    });

    gsap.from(canvas, { autoAlpha: 0, duration: 1.2, delay: .2, ease: 'power2.out' });
})();

/* Diagnostic : ajouter ?hxdebug à l'URL affiche les erreurs JS en bas de page */
if (/hxdebug/.test(location.search)) {
    var dbg = document.createElement('pre');
    dbg.style.cssText = 'position:fixed;left:0;bottom:0;right:0;z-index:99999;margin:0;padding:8px;background:#300;color:#fff;font:12px monospace;white-space:pre-wrap;max-height:40vh;overflow:auto';
    dbg.textContent = 'gsap=' + !!window.gsap + ' three=' + !!window.THREE + ' motion=' + !!window.__gsapMotion;
    document.body.appendChild(dbg);
    window.addEventListener('error', function (e) { dbg.textContent += '\nERR: ' + e.message + ' @' + (e.filename || '').split('/').pop() + ':' + e.lineno; });
}
