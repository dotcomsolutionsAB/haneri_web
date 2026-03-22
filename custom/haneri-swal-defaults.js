/**
 * Merge Haneri SweetAlert2 defaults into every Swal.fire() call.
 * Safe to load once after sweetalert2@11.
 */
(function () {
    if (typeof Swal === "undefined" || window.__HANERI_SWAL_DEFAULTS__) {
        return;
    }
    window.__HANERI_SWAL_DEFAULTS__ = true;

    var THEME = {
        buttonsStyling: false,
        reverseButtons: true,
        customClass: {
            popup: "haneri-sw-popup",
            title: "haneri-sw-title",
            htmlContainer: "haneri-sw-text",
            actions: "haneri-sw-actions",
            confirmButton: "haneri-sw-btn haneri-sw-btn-primary",
            denyButton: "haneri-sw-btn haneri-sw-btn-cancel",
            cancelButton: "haneri-sw-btn haneri-sw-btn-cancel"
        }
    };

    function mergeCustomClass(base, extra) {
        var out = {};
        var k;
        if (base) {
            for (k in base) {
                if (Object.prototype.hasOwnProperty.call(base, k)) {
                    out[k] = base[k];
                }
            }
        }
        if (extra && typeof extra === "object") {
            for (k in extra) {
                if (Object.prototype.hasOwnProperty.call(extra, k)) {
                    if (out[k] && extra[k]) {
                        out[k] = out[k] + " " + extra[k];
                    } else {
                        out[k] = extra[k];
                    }
                }
            }
        }
        return out;
    }

    var origFire = Swal.fire.bind(Swal);

    Swal.fire = function () {
        if (arguments.length === 0) {
            return origFire();
        }

        // Swal.fire('Title', 'text', 'icon')
        if (typeof arguments[0] === "string") {
            return origFire(
                Object.assign({}, THEME, {
                    title: arguments[0],
                    text: arguments[1],
                    icon: arguments[2] === undefined ? undefined : arguments[2]
                })
            );
        }

        var opts = arguments[0];
        if (typeof opts !== "object" || opts === null) {
            return origFire(opts);
        }

        var merged = Object.assign({}, THEME, opts);
        merged.customClass = mergeCustomClass(THEME.customClass, opts.customClass);
        return origFire(merged);
    };
})();
