export const select = (el, all = false) => {
    el = el.trim();

    return all ? [...document.querySelectorAll(el)] : document.querySelector(el);
};

export const on = (type, el, listener, all = false) => {
    const elements = typeof el === 'string' ? select(el, all) : el;

    if (all && Array.isArray(elements)) {
        elements.forEach((e) => e.addEventListener(type, listener));
    } else if (elements instanceof Element || elements === document) {
        elements.addEventListener(type, listener);
    }
};

export const onscroll = (el, listener) => {
    if (el instanceof Element || el === document) {
        el.addEventListener('scroll', listener);
    }
};
