(() => {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const members = Array.isArray(window.estagiaMembers) ? window.estagiaMembers : [];
    const body = document.body;

    const ready = () => {
        body.classList.add('is-ready');
        window.setTimeout(() => document.querySelector('.page-loader')?.classList.add('is-hidden'), 280);
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', ready, { once: true });
    } else {
        ready();
    }

    const header = document.querySelector('.site-header');
    let lastScroll = window.scrollY;
    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;
        header?.classList.toggle('is-scrolled', currentScroll > 24);
        if (currentScroll > 140 && currentScroll > lastScroll + 8) header?.classList.add('is-hidden');
        if (currentScroll < lastScroll - 8) header?.classList.remove('is-hidden');
        lastScroll = currentScroll;
    }, { passive: true });

    const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.main-nav');
    menuToggle?.addEventListener('click', () => {
        const isOpen = menuToggle.classList.toggle('is-open');
        navigation?.classList.toggle('is-open', isOpen);
        menuToggle.setAttribute('aria-expanded', String(isOpen));
    });
    navigation?.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
        menuToggle?.classList.remove('is-open');
        navigation.classList.remove('is-open');
        menuToggle?.setAttribute('aria-expanded', 'false');
    }));

    // Mantém as âncoras previsíveis em desktop e mobile, inclusive quando o header está fixo.
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (event) => {
            const targetId = anchor.getAttribute('href');
            const target = targetId ? document.querySelector(targetId) : null;
            if (!target) return;
            event.preventDefault();
            header?.classList.remove('is-hidden');
            target.scrollIntoView({ behavior: prefersReducedMotion ? 'auto' : 'smooth', block: 'start' });
            window.history.pushState(null, '', targetId);
        });
    });

    const sections = [...document.querySelectorAll('main section[id]')];
    const navLinks = [...document.querySelectorAll('.nav-link')];
    if ('IntersectionObserver' in window) {
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                navLinks.forEach((link) => link.classList.toggle('is-active', link.getAttribute('href') === `#${entry.target.id}`));
            });
        }, { rootMargin: '-35% 0px -55% 0px' });
        sections.forEach((section) => sectionObserver.observe(section));
    }

    const gsapReady = Boolean(window.gsap && window.ScrollTrigger && !prefersReducedMotion);
    const revealItems = [...document.querySelectorAll('[data-reveal]')]
        .filter((item) => !(gsapReady && item.closest('#sobre, #membros')));
    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    } else {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: .14, rootMargin: '0px 0px -9% 0px' });
        revealItems.forEach((item) => revealObserver.observe(item));
    }

    if (gsapReady) {
        const { gsap, ScrollTrigger } = window;
        gsap.registerPlugin(ScrollTrigger);

        const heroTimeline = gsap.timeline({ defaults: { ease: 'power3.out' } });
        heroTimeline.from('.hero .section-kicker', { autoAlpha: 0, y: 18, duration: .65 })
            .from('.hero h1', { autoAlpha: 0, y: 36, duration: 1 }, '-=.35')
            .from('.hero-description', { autoAlpha: 0, y: 22, duration: .7 }, '-=.55')
            .from('.hero-actions', { autoAlpha: 0, y: 18, duration: .65 }, '-=.4');
        gsap.to('.hero-banner-image', {
            yPercent: 6,
            scale: 1.08,
            ease: 'none',
            scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: .8 },
        });

        const about = document.querySelector('#sobre');
        if (about) {
            const aboutHeading = about.querySelector('.section-heading');
            const aboutCopy = about.querySelector('.intro-copy');
            const aboutProfile = about.querySelector('.about-showcase');
            const purposeCards = about.querySelectorAll('.about-info-card');
            const principlesSection = about.querySelector('.values-showcase');
            const principleCards = about.querySelectorAll('.value-feature-card');
            const swotSection = about.querySelector('.swot-showcase');
            const swotCards = about.querySelectorAll('.swot-panel');
            const aboutTimeline = gsap.timeline({
                defaults: { ease: 'power3.out' },
                scrollTrigger: { trigger: about, start: 'top 72%', once: true },
            });
            aboutTimeline
                .fromTo(aboutHeading, { autoAlpha: 0, x: -34 }, { autoAlpha: 1, x: 0, duration: .85 })
                .fromTo(aboutCopy, { autoAlpha: 0, y: 28 }, { autoAlpha: 1, y: 0, duration: .75 }, '-=.52');
            gsap.fromTo(aboutProfile, { autoAlpha: 0, y: 32 }, {
                autoAlpha: 1, y: 0, duration: .7, ease: 'power3.out',
                scrollTrigger: { trigger: aboutProfile, start: 'top 78%', once: true },
            });
            gsap.fromTo(purposeCards, { autoAlpha: 0, y: 30, rotateX: 3 }, {
                autoAlpha: 1, y: 0, rotateX: 0, duration: .62, stagger: .1, transformOrigin: '50% 100%', ease: 'power3.out',
                scrollTrigger: { trigger: aboutProfile, start: 'top 74%', once: true },
            });
            gsap.fromTo(principlesSection, { autoAlpha: 0, y: 30 }, {
                autoAlpha: 1, y: 0, duration: .7, ease: 'power3.out',
                scrollTrigger: { trigger: principlesSection, start: 'top 78%', once: true },
            });
            gsap.fromTo(principleCards, { autoAlpha: 0, y: 28 }, {
                autoAlpha: 1, y: 0, duration: .55, stagger: .09, ease: 'power3.out',
                scrollTrigger: { trigger: principlesSection, start: 'top 74%', once: true },
            });
            gsap.fromTo(swotSection, { autoAlpha: 0, y: 34 }, {
                autoAlpha: 1, y: 0, duration: .75, ease: 'power3.out',
                scrollTrigger: { trigger: swotSection, start: 'top 80%', once: true },
            });
            gsap.fromTo(swotCards, { autoAlpha: 0, y: 28 }, {
                autoAlpha: 1, y: 0, duration: .58, stagger: .09, ease: 'power3.out',
                scrollTrigger: { trigger: swotSection, start: 'top 75%', once: true },
            });
        }

        const membersSection = document.querySelector('#membros');
        if (membersSection) {
            const membersHeading = membersSection.querySelector('.members-heading .section-heading');
            const membersIntro = membersSection.querySelector('.members-heading > p');
            const memberCards = membersSection.querySelectorAll('.member-card');
            const memberPhotos = membersSection.querySelectorAll('.member-image-wrap img');
            const membersTimeline = gsap.timeline({
                defaults: { ease: 'power3.out' },
                scrollTrigger: { trigger: membersSection, start: 'top 70%', once: true },
            });
            membersTimeline
                .fromTo(membersHeading, { autoAlpha: 0, x: -34 }, { autoAlpha: 1, x: 0, duration: .82 })
                .fromTo(membersIntro, { autoAlpha: 0, y: 24 }, { autoAlpha: 1, y: 0, duration: .68 }, '-=.47')
                .fromTo(memberCards, { autoAlpha: 0, y: 46, scale: .985 }, { autoAlpha: 1, y: 0, scale: 1, duration: .65, stagger: .1 }, '-=.15');
            gsap.fromTo(memberPhotos, { scale: 1.1 }, {
                scale: 1,
                duration: 1.05,
                stagger: .1,
                ease: 'power2.out',
                scrollTrigger: { trigger: membersSection, start: 'top 66%', once: true },
            });
        }
    }

    const modal = document.querySelector('#member-modal');
    const modalClose = modal?.querySelector('.modal-close');
    let previousFocus = null;

    const text = (selector, value) => {
        const element = document.querySelector(selector);
        if (element) element.textContent = value || '';
    };

    const renderModal = (member) => {
        text('#modal-member-name', member.name);
        text('#modal-member-eyebrow', member.eyebrow);
        text('#modal-member-role', member.role);
        text('#modal-member-bio', member.bio);
        const image = document.querySelector('#modal-member-image');
        if (image) {
            image.src = `${document.body.dataset.baseUrl || ''}/public/${member.image}`.replace('//public', '/public');
            image.alt = `Retrato de ${member.name}`;
        }
        const strengths = document.querySelector('#modal-member-strengths');
        if (strengths) {
            strengths.replaceChildren(...(member.strengths || []).map((item) => {
                const li = document.createElement('li');
                li.textContent = item;
                return li;
            }));
        }
        const skills = document.querySelector('#modal-member-skills');
        if (skills) {
            skills.replaceChildren(...(member.skills || []).map((item) => {
                const span = document.createElement('span');
                span.textContent = item;
                return span;
            }));
        }
        const links = document.querySelector('#modal-member-links');
        if (links) {
            const candidates = [];
            if (member.email) candidates.push({ label: 'E-mail', href: `mailto:${member.email}` });
            if (member.linkedin) candidates.push({ label: 'LinkedIn', href: member.linkedin });
            if (member.github) candidates.push({ label: 'GitHub', href: member.github });
            if (member.portfolio) candidates.push({ label: 'Portfólio em construção', href: member.portfolio });
            links.replaceChildren(...candidates.map(({ label, href }) => {
                const anchor = document.createElement('a');
                anchor.href = href;
                anchor.target = '_blank';
                anchor.rel = 'noopener noreferrer';
                anchor.textContent = label;
                return anchor;
            }));
        }
    };

    const openModal = (memberId, trigger) => {
        const member = members.find((item) => item.id === memberId);
        if (!member || !modal) return;
        previousFocus = trigger;
        renderModal(member);
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        body.classList.add('modal-open');
        modalClose?.focus();
    };
    const closeModal = () => {
        if (!modal) return;
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        body.classList.remove('modal-open');
        previousFocus?.focus();
    };

    document.querySelectorAll('[data-member-card]').forEach((card) => {
        const button = card.querySelector('.member-card-button');
        button?.addEventListener('click', () => openModal(card.dataset.memberId, button));
    });
    modalClose?.addEventListener('click', closeModal);
    modal?.addEventListener('click', (event) => { if (event.target === modal) closeModal(); });
    document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && modal?.classList.contains('is-open')) closeModal(); });
})();
