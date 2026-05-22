@extends('userLayouts.app')

@section('content')

<style>
:root {
    --mgmt-ink: #111827;
    --mgmt-muted: #667085;
    --mgmt-line: #d8dee8;
    --mgmt-soft: #f6f7f9;
    --mgmt-gold: #b9933f;
    --mgmt-blue: #234d73;
    --mgmt-site-nav-height: 78px;
    --mgmt-tabs-height: 82px;
}

html {
    scroll-behavior: smooth;
}

.mgmt-page {
    background: #fff;
    color: var(--mgmt-ink);
    direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
    padding: 46px 22px 90px;
}

.mgmt-shell {
    max-width: 1160px;
    margin: 0 auto;
}

.mgmt-tabs {
    position: sticky;
    top: var(--mgmt-site-nav-height);
    z-index: 120;
    background: rgba(255,255,255,.94);
    border-block: 1px solid var(--mgmt-line);
    backdrop-filter: blur(10px);
    margin-bottom: 42px;
    padding: 14px 0;
    box-shadow: 0 10px 24px rgba(17,24,39,.06);
}

.mgmt-tabs__inner {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

.mgmt-tab {
    border: 1px solid var(--mgmt-line);
    border-radius: 6px;
    color: var(--mgmt-ink);
    background: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 44px;
    padding: 9px 18px;
    font-size: 1.35rem;
    font-weight: 800;
    text-decoration: none;
    transition: background .2s ease, color .2s ease, border-color .2s ease, transform .2s ease;
}

.mgmt-tab:hover,
.mgmt-tab.is-active {
    background: var(--mgmt-ink);
    border-color: var(--mgmt-ink);
    color: #fff;
    transform: translateY(-1px);
}

.mgmt-section {
    scroll-margin-top: calc(var(--mgmt-site-nav-height) + var(--mgmt-tabs-height) + 18px);
    padding: 18px 0 56px;
}

.mgmt-section + .mgmt-section {
    border-top: 1px solid var(--mgmt-line);
}

.mgmt-section__heading {
    margin-bottom: 24px;
    text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
}

.mgmt-section__heading p {
    color: var(--mgmt-gold);
    font-size: 1.15rem;
    font-weight: 800;
    margin: 0 0 8px;
}

.mgmt-section__heading h2 {
    color: var(--mgmt-ink);
    font-size: clamp(2rem, 3vw, 3.2rem);
    line-height: 1.2;
    margin: 0;
}

.mgmt-section__list {
    display: grid;
    gap: 34px;
}

.mgmt-row-card {
    display: flex;
    flex-direction: row;
    gap: 28px;
    align-items: stretch;
    border-top: 1px solid var(--mgmt-ink);
    padding-top: 14px;
}

.mgmt-row-card__media {
    flex: 0 0 48%;
    min-width: 280px;
}

.mgmt-row-card__content {
    flex: 1 1 0;
}

.mgmt-row-card__photo {
    width: 100%;
    height: 100%;
    min-height: 330px;
    max-height: 430px;
    object-fit: cover;
    /* object-position: center top; */
    display: block;
    background: #6d6f73;
}

.mgmt-row-card__photo--empty {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 5rem;
    font-weight: 800;
}

.mgmt-row-card__content {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    min-width: 0;
    padding: 2px 0 0;
}

.mgmt-row-card__head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 18px;
    border-bottom: 1px solid var(--mgmt-line);
    padding-bottom: 10px;
    margin-bottom: 13px;
}

.mgmt-row-card__badge,
.mgmt-row-card__position {
    color: var(--mgmt-gold);
    font-size: 1.05rem;
    font-weight: 800;
}

.mgmt-row-card__position {
    color: var(--mgmt-blue);
    white-space: nowrap;
}

.mgmt-row-card__name {
    font-size: clamp(1.8rem, 2.4vw, 2.5rem);
    line-height: 1.25;
    margin: 5px 0 0;
}

.mgmt-row-card__bio {
    color: var(--mgmt-ink);
    font-size: 1.35rem;
    line-height: 1.9;
    margin: 0 0 18px;
}

.mgmt-row-card__details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 10px;
    margin: auto 0 0;
}

.mgmt-row-card__details div {
    background: var(--mgmt-soft);
    border: 1px solid #ebedf1;
    border-radius: 6px;
    padding: 12px 14px;
    min-width: 0;
}

.mgmt-row-card__details dt {
    color: var(--mgmt-muted);
    font-size: 1rem;
    font-weight: 800;
    margin-bottom: 4px;
}

.mgmt-row-card__details dd {
    color: var(--mgmt-ink);
    font-size: 1.12rem;
    font-weight: 700;
    margin: 0;
    overflow-wrap: anywhere;
}

.mgmt-row-card__details a {
    color: var(--mgmt-blue);
    text-decoration: none;
}

.mgmt-row-card__details a:hover {
    text-decoration: underline;
}

.mgmt-empty {
    color: var(--mgmt-muted);
    background: var(--mgmt-soft);
    border: 1px solid var(--mgmt-line);
    border-radius: 6px;
    margin: 0;
    padding: 28px;
    text-align: center;
    font-size: 1.2rem;
}

@media (max-width: 820px) {
    .mgmt-page {
        padding-inline: 16px;
    }

    .mgmt-tabs {
        top: var(--mgmt-site-nav-height);
        margin-inline: -16px;
        padding-inline: 16px;
    }

    .mgmt-tabs__inner {
        justify-content: stretch;
    }

    .mgmt-tab {
        flex: 1 1 210px;
        font-size: 1.1rem;
        padding-inline: 12px;
    }

    .mgmt-row-card,
    .mgmt-page[dir="rtl"] .mgmt-row-card {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .mgmt-row-card__media {
        flex-basis: auto;
        min-width: 0;
    }

    .mgmt-row-card__photo {
        min-height: 280px;
        max-height: none;
        aspect-ratio: 4 / 3;
    }

    .mgmt-row-card__head {
        flex-direction: column;
        gap: 8px;
    }

    .mgmt-row-card__position {
        white-space: normal;
    }

    .mgmt-row-card__bio {
        font-size: 1.18rem;
        line-height: 1.75;
    }
}
</style>

<section class="page-header">
    <div class="row page-header__content narrower text-center">
        <div class="col-full">
            {{-- <h3 class="subhead">{{ __('management.page_title') }}</h3> --}}
            <h1 class="display-1">{{ __('management.title') }}</h1>
        </div>
    </div>
</section>

<main class="mgmt-page" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="mgmt-shell">
        <nav class="mgmt-tabs" aria-label="{{ __('management.tabs_label') }}">
            <div class="mgmt-tabs__inner">
                <a class="mgmt-tab" href="#current-management">{{ __('management.tab_current') }}</a>
                <a class="mgmt-tab" href="#honorary-president">{{ __('management.tab_honorary_president') }}</a>
                <a class="mgmt-tab" href="#advisory-committee">{{ __('management.tab_advisory') }}</a>
                <a class="mgmt-tab" href="#former-presidents">{{ __('management.tab_former_presidents') }}</a>
            </div>
        </nav>

        @include('Management._management_section', [
            'id' => 'current-management',
            'title' => __('management.tab_current'),
            'members' => $currentMembers,
            'empty' => __('management.no_current'),
        ])

        @include('Management._management_section', [
            'id' => 'honorary-president',
            'title' => __('management.tab_honorary_president'),
            'members' => $honoraryMembers,
            'empty' => __('management.no_honorary_president'),
            'badge' => __('management.honorary_president_label'),
        ])

        @include('Management._management_section', [
            'id' => 'advisory-committee',
            'title' => __('management.tab_advisory'),
            'members' => $advisoryMembers,
            'empty' => __('management.no_advisory'),
            'badge' => __('management.consultant_label'),
        ])

        @include('Management._management_section', [
            'id' => 'former-presidents',
            'title' => __('management.tab_former_presidents'),
            'members' => $formerMembers,
            'empty' => __('management.no_former'),
        ])
    </div>
</main>

<script>
const mgmtTabs = Array.from(document.querySelectorAll('.mgmt-tab'));
const mgmtSections = mgmtTabs
    .map(tab => document.querySelector(tab.getAttribute('href')))
    .filter(Boolean);

const mgmtStickyOffset = () => {
    const styles = getComputedStyle(document.documentElement);
    const navHeight = parseFloat(styles.getPropertyValue('--mgmt-site-nav-height')) || 78;
    const tabsHeight = document.querySelector('.mgmt-tabs')?.offsetHeight || 82;
    return navHeight + tabsHeight + 18;
};

const setActiveMgmtTab = () => {
    const probe = window.scrollY + mgmtStickyOffset() + 8;
    let current = mgmtSections[0]?.id || '';

    mgmtSections.forEach(section => {
        if (section.offsetTop <= probe) {
            current = section.id;
        }
    });

    mgmtTabs.forEach(tab => {
        const isActive = tab.getAttribute('href') === '#' + current;
        tab.classList.toggle('is-active', isActive);
        tab.toggleAttribute('aria-current', isActive);
    });
};

mgmtTabs.forEach(tab => {
    tab.addEventListener('click', event => {
        const target = document.querySelector(tab.getAttribute('href'));
        if (!target) return;

        event.preventDefault();
        window.scrollTo({
            top: target.offsetTop - mgmtStickyOffset(),
            behavior: 'smooth',
        });
    });
});

window.addEventListener('scroll', setActiveMgmtTab, { passive: true });
window.addEventListener('resize', setActiveMgmtTab);
window.addEventListener('load', setActiveMgmtTab);
</script>

@endsection
