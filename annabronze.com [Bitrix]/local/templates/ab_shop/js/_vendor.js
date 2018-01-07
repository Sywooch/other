!function (e, t) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function (e) {
        if (!e.document)throw new Error("jQuery requires a window with a document");
        return t(e)
    } : t(e)
}("undefined" != typeof window ? window : this, function (e, t) {
    "use strict";
    function n(e, t) {
        t = t || te;
        var n = t.createElement("script");
        n.text = e, t.head.appendChild(n).parentNode.removeChild(n)
    }

    function i(e) {
        var t = !!e && "length" in e && e.length, n = he.type(e);
        return "function" !== n && !he.isWindow(e) && ("array" === n || 0 === t || "number" == typeof t && t > 0 && t - 1 in e)
    }

    function a(e, t, n) {
        return he.isFunction(t) ? he.grep(e, function (e, i) {
            return !!t.call(e, i, e) !== n
        }) : t.nodeType ? he.grep(e, function (e) {
            return e === t !== n
        }) : "string" != typeof t ? he.grep(e, function (e) {
            return oe.call(t, e) > -1 !== n
        }) : Se.test(t) ? he.filter(t, e, n) : (t = he.filter(t, e), he.grep(e, function (e) {
            return oe.call(t, e) > -1 !== n && 1 === e.nodeType
        }))
    }

    function r(e, t) {
        for (; (e = e[t]) && 1 !== e.nodeType;);
        return e
    }

    function o(e) {
        var t = {};
        return he.each(e.match(De) || [], function (e, n) {
            t[n] = !0
        }), t
    }

    function s(e) {
        return e
    }

    function l(e) {
        throw e
    }

    function d(e, t, n) {
        var i;
        try {
            e && he.isFunction(i = e.promise) ? i.call(e).done(t).fail(n) : e && he.isFunction(i = e.then) ? i.call(e, t, n) : t.call(void 0, e)
        } catch (e) {
            n.call(void 0, e)
        }
    }

    function c() {
        te.removeEventListener("DOMContentLoaded", c), e.removeEventListener("load", c), he.ready()
    }

    function p() {
        this.expando = he.expando + p.uid++
    }

    function u(e) {
        return "true" === e || "false" !== e && ("null" === e ? null : e === +e + "" ? +e : Oe.test(e) ? JSON.parse(e) : e)
    }

    function f(e, t, n) {
        var i;
        if (void 0 === n && 1 === e.nodeType)if (i = "data-" + t.replace(qe, "-$&").toLowerCase(), n = e.getAttribute(i), "string" == typeof n) {
            try {
                n = u(n)
            } catch (a) {
            }
            Ne.set(e, t, n)
        } else n = void 0;
        return n
    }

    function h(e, t, n, i) {
        var a, r = 1, o = 20, s = i ? function () {
            return i.cur()
        } : function () {
            return he.css(e, t, "")
        }, l = s(), d = n && n[3] || (he.cssNumber[t] ? "" : "px"), c = (he.cssNumber[t] || "px" !== d && +l) && Re.exec(he.css(e, t));
        if (c && c[3] !== d) {
            d = d || c[3], n = n || [], c = +l || 1;
            do r = r || ".5", c /= r, he.style(e, t, c + d); while (r !== (r = s() / l) && 1 !== r && --o)
        }
        return n && (c = +c || +l || 0, a = n[1] ? c + (n[1] + 1) * n[2] : +n[2], i && (i.unit = d, i.start = c, i.end = a)), a
    }

    function m(e) {
        var t, n = e.ownerDocument, i = e.nodeName, a = Xe[i];
        return a ? a : (t = n.body.appendChild(n.createElement(i)), a = he.css(t, "display"), t.parentNode.removeChild(t), "none" === a && (a = "block"), Xe[i] = a, a)
    }

    function g(e, t) {
        for (var n, i, a = [], r = 0, o = e.length; r < o; r++)i = e[r], i.style && (n = i.style.display, t ? ("none" === n && (a[r] = je.get(i, "display") || null, a[r] || (i.style.display = "")), "" === i.style.display && _e(i) && (a[r] = m(i))) : "none" !== n && (a[r] = "none", je.set(i, "display", n)));
        for (r = 0; r < o; r++)null != a[r] && (e[r].style.display = a[r]);
        return e
    }

    function v(e, t) {
        var n;
        return n = "undefined" != typeof e.getElementsByTagName ? e.getElementsByTagName(t || "*") : "undefined" != typeof e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && he.nodeName(e, t) ? he.merge([e], n) : n
    }

    function y(e, t) {
        for (var n = 0, i = e.length; n < i; n++)je.set(e[n], "globalEval", !t || je.get(t[n], "globalEval"))
    }

    function w(e, t, n, i, a) {
        for (var r, o, s, l, d, c, p = t.createDocumentFragment(), u = [], f = 0, h = e.length; f < h; f++)if (r = e[f], r || 0 === r)if ("object" === he.type(r))he.merge(u, r.nodeType ? [r] : r); else if (Ke.test(r)) {
            for (o = o || p.appendChild(t.createElement("div")), s = (Ge.exec(r) || ["", ""])[1].toLowerCase(), l = $e[s] || $e._default, o.innerHTML = l[1] + he.htmlPrefilter(r) + l[2], c = l[0]; c--;)o = o.lastChild;
            he.merge(u, o.childNodes), o = p.firstChild, o.textContent = ""
        } else u.push(t.createTextNode(r));
        for (p.textContent = "", f = 0; r = u[f++];)if (i && he.inArray(r, i) > -1)a && a.push(r); else if (d = he.contains(r.ownerDocument, r), o = v(p.appendChild(r), "script"), d && y(o), n)for (c = 0; r = o[c++];)Ve.test(r.type || "") && n.push(r);
        return p
    }

    function x() {
        return !0
    }

    function b() {
        return !1
    }

    function C() {
        try {
            return te.activeElement
        } catch (e) {
        }
    }

    function T(e, t, n, i, a, r) {
        var o, s;
        if ("object" == typeof t) {
            "string" != typeof n && (i = i || n, n = void 0);
            for (s in t)T(e, s, n, i, t[s], r);
            return e
        }
        if (null == i && null == a ? (a = n, i = n = void 0) : null == a && ("string" == typeof n ? (a = i, i = void 0) : (a = i, i = n, n = void 0)), a === !1)a = b; else if (!a)return e;
        return 1 === r && (o = a, a = function (e) {
            return he().off(e), o.apply(this, arguments)
        }, a.guid = o.guid || (o.guid = he.guid++)), e.each(function () {
            he.event.add(this, t, a, i, n)
        })
    }

    function S(e, t) {
        return he.nodeName(e, "table") && he.nodeName(11 !== t.nodeType ? t : t.firstChild, "tr") ? e.getElementsByTagName("tbody")[0] || e : e
    }

    function k(e) {
        return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
    }

    function E(e) {
        var t = it.exec(e.type);
        return t ? e.type = t[1] : e.removeAttribute("type"), e
    }

    function M(e, t) {
        var n, i, a, r, o, s, l, d;
        if (1 === t.nodeType) {
            if (je.hasData(e) && (r = je.access(e), o = je.set(t, r), d = r.events)) {
                delete o.handle, o.events = {};
                for (a in d)for (n = 0, i = d[a].length; n < i; n++)he.event.add(t, a, d[a][n])
            }
            Ne.hasData(e) && (s = Ne.access(e), l = he.extend({}, s), Ne.set(t, l))
        }
    }

    function z(e, t) {
        var n = t.nodeName.toLowerCase();
        "input" === n && Ye.test(e.type) ? t.checked = e.checked : "input" !== n && "textarea" !== n || (t.defaultValue = e.defaultValue)
    }

    function P(e, t, i, a) {
        t = ae.apply([], t);
        var r, o, s, l, d, c, p = 0, u = e.length, f = u - 1, h = t[0], m = he.isFunction(h);
        if (m || u > 1 && "string" == typeof h && !ue.checkClone && nt.test(h))return e.each(function (n) {
            var r = e.eq(n);
            m && (t[0] = h.call(this, n, r.html())), P(r, t, i, a)
        });
        if (u && (r = w(t, e[0].ownerDocument, !1, e, a), o = r.firstChild, 1 === r.childNodes.length && (r = o), o || a)) {
            for (s = he.map(v(r, "script"), k), l = s.length; p < u; p++)d = r, p !== f && (d = he.clone(d, !0, !0), l && he.merge(s, v(d, "script"))), i.call(e[p], d, p);
            if (l)for (c = s[s.length - 1].ownerDocument, he.map(s, E), p = 0; p < l; p++)d = s[p], Ve.test(d.type || "") && !je.access(d, "globalEval") && he.contains(c, d) && (d.src ? he._evalUrl && he._evalUrl(d.src) : n(d.textContent.replace(at, ""), c))
        }
        return e
    }

    function D(e, t, n) {
        for (var i, a = t ? he.filter(t, e) : e, r = 0; null != (i = a[r]); r++)n || 1 !== i.nodeType || he.cleanData(v(i)), i.parentNode && (n && he.contains(i.ownerDocument, i) && y(v(i, "script")), i.parentNode.removeChild(i));
        return e
    }

    function L(e, t, n) {
        var i, a, r, o, s = e.style;
        return n = n || st(e), n && (o = n.getPropertyValue(t) || n[t], "" !== o || he.contains(e.ownerDocument, e) || (o = he.style(e, t)), !ue.pixelMarginRight() && ot.test(o) && rt.test(t) && (i = s.width, a = s.minWidth, r = s.maxWidth, s.minWidth = s.maxWidth = s.width = o, o = n.width, s.width = i, s.minWidth = a, s.maxWidth = r)), void 0 !== o ? o + "" : o
    }

    function A(e, t) {
        return {
            get: function () {
                return e() ? void delete this.get : (this.get = t).apply(this, arguments)
            }
        }
    }

    function H(e) {
        if (e in ut)return e;
        for (var t = e[0].toUpperCase() + e.slice(1), n = pt.length; n--;)if (e = pt[n] + t, e in ut)return e
    }

    function I(e, t, n) {
        var i = Re.exec(t);
        return i ? Math.max(0, i[2] - (n || 0)) + (i[3] || "px") : t
    }

    function j(e, t, n, i, a) {
        var r, o = 0;
        for (r = n === (i ? "border" : "content") ? 4 : "width" === t ? 1 : 0; r < 4; r += 2)"margin" === n && (o += he.css(e, n + Be[r], !0, a)), i ? ("content" === n && (o -= he.css(e, "padding" + Be[r], !0, a)), "margin" !== n && (o -= he.css(e, "border" + Be[r] + "Width", !0, a))) : (o += he.css(e, "padding" + Be[r], !0, a), "padding" !== n && (o += he.css(e, "border" + Be[r] + "Width", !0, a)));
        return o
    }

    function N(e, t, n) {
        var i, a = !0, r = st(e), o = "border-box" === he.css(e, "boxSizing", !1, r);
        if (e.getClientRects().length && (i = e.getBoundingClientRect()[t]), i <= 0 || null == i) {
            if (i = L(e, t, r), (i < 0 || null == i) && (i = e.style[t]), ot.test(i))return i;
            a = o && (ue.boxSizingReliable() || i === e.style[t]), i = parseFloat(i) || 0
        }
        return i + j(e, t, n || (o ? "border" : "content"), a, r) + "px"
    }

    function O(e, t, n, i, a) {
        return new O.prototype.init(e, t, n, i, a)
    }

    function q() {
        ht && (e.requestAnimationFrame(q), he.fx.tick())
    }

    function W() {
        return e.setTimeout(function () {
            ft = void 0
        }), ft = he.now()
    }

    function R(e, t) {
        var n, i = 0, a = {height: e};
        for (t = t ? 1 : 0; i < 4; i += 2 - t)n = Be[i], a["margin" + n] = a["padding" + n] = e;
        return t && (a.opacity = a.width = e), a
    }

    function B(e, t, n) {
        for (var i, a = (X.tweeners[t] || []).concat(X.tweeners["*"]), r = 0, o = a.length; r < o; r++)if (i = a[r].call(n, t, e))return i
    }

    function _(e, t, n) {
        var i, a, r, o, s, l, d, c, p = "width" in t || "height" in t, u = this, f = {}, h = e.style, m = e.nodeType && _e(e), v = je.get(e, "fxshow");
        n.queue || (o = he._queueHooks(e, "fx"), null == o.unqueued && (o.unqueued = 0, s = o.empty.fire, o.empty.fire = function () {
            o.unqueued || s()
        }), o.unqueued++, u.always(function () {
            u.always(function () {
                o.unqueued--, he.queue(e, "fx").length || o.empty.fire()
            })
        }));
        for (i in t)if (a = t[i], mt.test(a)) {
            if (delete t[i], r = r || "toggle" === a, a === (m ? "hide" : "show")) {
                if ("show" !== a || !v || void 0 === v[i])continue;
                m = !0
            }
            f[i] = v && v[i] || he.style(e, i)
        }
        if (l = !he.isEmptyObject(t), l || !he.isEmptyObject(f)) {
            p && 1 === e.nodeType && (n.overflow = [h.overflow, h.overflowX, h.overflowY], d = v && v.display, null == d && (d = je.get(e, "display")), c = he.css(e, "display"), "none" === c && (d ? c = d : (g([e], !0), d = e.style.display || d, c = he.css(e, "display"), g([e]))), ("inline" === c || "inline-block" === c && null != d) && "none" === he.css(e, "float") && (l || (u.done(function () {
                h.display = d
            }), null == d && (c = h.display, d = "none" === c ? "" : c)), h.display = "inline-block")), n.overflow && (h.overflow = "hidden", u.always(function () {
                h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
            })), l = !1;
            for (i in f)l || (v ? "hidden" in v && (m = v.hidden) : v = je.access(e, "fxshow", {display: d}), r && (v.hidden = !m), m && g([e], !0), u.done(function () {
                m || g([e]), je.remove(e, "fxshow");
                for (i in f)he.style(e, i, f[i])
            })), l = B(m ? v[i] : 0, i, u), i in v || (v[i] = l.start, m && (l.end = l.start, l.start = 0))
        }
    }

    function F(e, t) {
        var n, i, a, r, o;
        for (n in e)if (i = he.camelCase(n), a = t[i], r = e[n], he.isArray(r) && (a = r[1], r = e[n] = r[0]), n !== i && (e[i] = r, delete e[n]), o = he.cssHooks[i], o && "expand" in o) {
            r = o.expand(r), delete e[i];
            for (n in r)n in e || (e[n] = r[n], t[n] = a)
        } else t[i] = a
    }

    function X(e, t, n) {
        var i, a, r = 0, o = X.prefilters.length, s = he.Deferred().always(function () {
            delete l.elem
        }), l = function () {
            if (a)return !1;
            for (var t = ft || W(), n = Math.max(0, d.startTime + d.duration - t), i = n / d.duration || 0, r = 1 - i, o = 0, l = d.tweens.length; o < l; o++)d.tweens[o].run(r);
            return s.notifyWith(e, [d, r, n]), r < 1 && l ? n : (s.resolveWith(e, [d]), !1)
        }, d = s.promise({
            elem: e,
            props: he.extend({}, t),
            opts: he.extend(!0, {specialEasing: {}, easing: he.easing._default}, n),
            originalProperties: t,
            originalOptions: n,
            startTime: ft || W(),
            duration: n.duration,
            tweens: [],
            createTween: function (t, n) {
                var i = he.Tween(e, d.opts, t, n, d.opts.specialEasing[t] || d.opts.easing);
                return d.tweens.push(i), i
            },
            stop: function (t) {
                var n = 0, i = t ? d.tweens.length : 0;
                if (a)return this;
                for (a = !0; n < i; n++)d.tweens[n].run(1);
                return t ? (s.notifyWith(e, [d, 1, 0]), s.resolveWith(e, [d, t])) : s.rejectWith(e, [d, t]), this
            }
        }), c = d.props;
        for (F(c, d.opts.specialEasing); r < o; r++)if (i = X.prefilters[r].call(d, e, c, d.opts))return he.isFunction(i.stop) && (he._queueHooks(d.elem, d.opts.queue).stop = he.proxy(i.stop, i)), i;
        return he.map(c, B, d), he.isFunction(d.opts.start) && d.opts.start.call(e, d), he.fx.timer(he.extend(l, {
            elem: e,
            anim: d,
            queue: d.opts.queue
        })), d.progress(d.opts.progress).done(d.opts.done, d.opts.complete).fail(d.opts.fail).always(d.opts.always)
    }

    function Y(e) {
        var t = e.match(De) || [];
        return t.join(" ")
    }

    function G(e) {
        return e.getAttribute && e.getAttribute("class") || ""
    }

    function V(e, t, n, i) {
        var a;
        if (he.isArray(t))he.each(t, function (t, a) {
            n || Et.test(e) ? i(e, a) : V(e + "[" + ("object" == typeof a && null != a ? t : "") + "]", a, n, i)
        }); else if (n || "object" !== he.type(t))i(e, t); else for (a in t)V(e + "[" + a + "]", t[a], n, i)
    }

    function $(e) {
        return function (t, n) {
            "string" != typeof t && (n = t, t = "*");
            var i, a = 0, r = t.toLowerCase().match(De) || [];
            if (he.isFunction(n))for (; i = r[a++];)"+" === i[0] ? (i = i.slice(1) || "*", (e[i] = e[i] || []).unshift(n)) : (e[i] = e[i] || []).push(n)
        }
    }

    function K(e, t, n, i) {
        function a(s) {
            var l;
            return r[s] = !0, he.each(e[s] || [], function (e, s) {
                var d = s(t, n, i);
                return "string" != typeof d || o || r[d] ? o ? !(l = d) : void 0 : (t.dataTypes.unshift(d), a(d), !1)
            }), l
        }

        var r = {}, o = e === qt;
        return a(t.dataTypes[0]) || !r["*"] && a("*")
    }

    function U(e, t) {
        var n, i, a = he.ajaxSettings.flatOptions || {};
        for (n in t)void 0 !== t[n] && ((a[n] ? e : i || (i = {}))[n] = t[n]);
        return i && he.extend(!0, e, i), e
    }

    function Z(e, t, n) {
        for (var i, a, r, o, s = e.contents, l = e.dataTypes; "*" === l[0];)l.shift(), void 0 === i && (i = e.mimeType || t.getResponseHeader("Content-Type"));
        if (i)for (a in s)if (s[a] && s[a].test(i)) {
            l.unshift(a);
            break
        }
        if (l[0] in n)r = l[0]; else {
            for (a in n) {
                if (!l[0] || e.converters[a + " " + l[0]]) {
                    r = a;
                    break
                }
                o || (o = a)
            }
            r = r || o
        }
        if (r)return r !== l[0] && l.unshift(r), n[r]
    }

    function Q(e, t, n, i) {
        var a, r, o, s, l, d = {}, c = e.dataTypes.slice();
        if (c[1])for (o in e.converters)d[o.toLowerCase()] = e.converters[o];
        for (r = c.shift(); r;)if (e.responseFields[r] && (n[e.responseFields[r]] = t), !l && i && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = r, r = c.shift())if ("*" === r)r = l; else if ("*" !== l && l !== r) {
            if (o = d[l + " " + r] || d["* " + r], !o)for (a in d)if (s = a.split(" "), s[1] === r && (o = d[l + " " + s[0]] || d["* " + s[0]])) {
                o === !0 ? o = d[a] : d[a] !== !0 && (r = s[0], c.unshift(s[1]));
                break
            }
            if (o !== !0)if (o && e["throws"])t = o(t); else try {
                t = o(t)
            } catch (p) {
                return {state: "parsererror", error: o ? p : "No conversion from " + l + " to " + r}
            }
        }
        return {state: "success", data: t}
    }

    function J(e) {
        return he.isWindow(e) ? e : 9 === e.nodeType && e.defaultView
    }

    var ee = [], te = e.document, ne = Object.getPrototypeOf, ie = ee.slice, ae = ee.concat, re = ee.push, oe = ee.indexOf, se = {}, le = se.toString, de = se.hasOwnProperty, ce = de.toString, pe = ce.call(Object), ue = {}, fe = "3.1.1", he = function (e, t) {
        return new he.fn.init(e, t)
    }, me = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, ge = /^-ms-/, ve = /-([a-z])/g, ye = function (e, t) {
        return t.toUpperCase()
    };
    he.fn = he.prototype = {
        jquery: fe, constructor: he, length: 0, toArray: function () {
            return ie.call(this)
        }, get: function (e) {
            return null == e ? ie.call(this) : e < 0 ? this[e + this.length] : this[e]
        }, pushStack: function (e) {
            var t = he.merge(this.constructor(), e);
            return t.prevObject = this, t
        }, each: function (e) {
            return he.each(this, e)
        }, map: function (e) {
            return this.pushStack(he.map(this, function (t, n) {
                return e.call(t, n, t)
            }))
        }, slice: function () {
            return this.pushStack(ie.apply(this, arguments))
        }, first: function () {
            return this.eq(0)
        }, last: function () {
            return this.eq(-1)
        }, eq: function (e) {
            var t = this.length, n = +e + (e < 0 ? t : 0);
            return this.pushStack(n >= 0 && n < t ? [this[n]] : [])
        }, end: function () {
            return this.prevObject || this.constructor()
        }, push: re, sort: ee.sort, splice: ee.splice
    }, he.extend = he.fn.extend = function () {
        var e, t, n, i, a, r, o = arguments[0] || {}, s = 1, l = arguments.length, d = !1;
        for ("boolean" == typeof o && (d = o, o = arguments[s] || {}, s++), "object" == typeof o || he.isFunction(o) || (o = {}), s === l && (o = this, s--); s < l; s++)if (null != (e = arguments[s]))for (t in e)n = o[t], i = e[t], o !== i && (d && i && (he.isPlainObject(i) || (a = he.isArray(i))) ? (a ? (a = !1, r = n && he.isArray(n) ? n : []) : r = n && he.isPlainObject(n) ? n : {}, o[t] = he.extend(d, r, i)) : void 0 !== i && (o[t] = i));
        return o
    }, he.extend({
        expando: "jQuery" + (fe + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (e) {
            throw new Error(e)
        }, noop: function () {
        }, isFunction: function (e) {
            return "function" === he.type(e)
        }, isArray: Array.isArray, isWindow: function (e) {
            return null != e && e === e.window
        }, isNumeric: function (e) {
            var t = he.type(e);
            return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e))
        }, isPlainObject: function (e) {
            var t, n;
            return !(!e || "[object Object]" !== le.call(e)) && (!(t = ne(e)) || (n = de.call(t, "constructor") && t.constructor, "function" == typeof n && ce.call(n) === pe))
        }, isEmptyObject: function (e) {
            var t;
            for (t in e)return !1;
            return !0
        }, type: function (e) {
            return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? se[le.call(e)] || "object" : typeof e
        }, globalEval: function (e) {
            n(e)
        }, camelCase: function (e) {
            return e.replace(ge, "ms-").replace(ve, ye)
        }, nodeName: function (e, t) {
            return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
        }, each: function (e, t) {
            var n, a = 0;
            if (i(e))for (n = e.length; a < n && t.call(e[a], a, e[a]) !== !1; a++); else for (a in e)if (t.call(e[a], a, e[a]) === !1)break;
            return e
        }, trim: function (e) {
            return null == e ? "" : (e + "").replace(me, "")
        }, makeArray: function (e, t) {
            var n = t || [];
            return null != e && (i(Object(e)) ? he.merge(n, "string" == typeof e ? [e] : e) : re.call(n, e)), n
        }, inArray: function (e, t, n) {
            return null == t ? -1 : oe.call(t, e, n)
        }, merge: function (e, t) {
            for (var n = +t.length, i = 0, a = e.length; i < n; i++)e[a++] = t[i];
            return e.length = a, e
        }, grep: function (e, t, n) {
            for (var i, a = [], r = 0, o = e.length, s = !n; r < o; r++)i = !t(e[r], r), i !== s && a.push(e[r]);
            return a
        }, map: function (e, t, n) {
            var a, r, o = 0, s = [];
            if (i(e))for (a = e.length; o < a; o++)r = t(e[o], o, n), null != r && s.push(r); else for (o in e)r = t(e[o], o, n), null != r && s.push(r);
            return ae.apply([], s)
        }, guid: 1, proxy: function (e, t) {
            var n, i, a;
            if ("string" == typeof t && (n = e[t], t = e, e = n), he.isFunction(e))return i = ie.call(arguments, 2), a = function () {
                return e.apply(t || this, i.concat(ie.call(arguments)))
            }, a.guid = e.guid = e.guid || he.guid++, a
        }, now: Date.now, support: ue
    }), "function" == typeof Symbol && (he.fn[Symbol.iterator] = ee[Symbol.iterator]), he.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (e, t) {
        se["[object " + t + "]"] = t.toLowerCase()
    });
    var we = function (e) {
        function t(e, t, n, i) {
            var a, r, o, s, l, d, c, u = t && t.ownerDocument, h = t ? t.nodeType : 9;
            if (n = n || [], "string" != typeof e || !e || 1 !== h && 9 !== h && 11 !== h)return n;
            if (!i && ((t ? t.ownerDocument || t : B) !== H && A(t), t = t || H, j)) {
                if (11 !== h && (l = ve.exec(e)))if (a = l[1]) {
                    if (9 === h) {
                        if (!(o = t.getElementById(a)))return n;
                        if (o.id === a)return n.push(o), n
                    } else if (u && (o = u.getElementById(a)) && W(t, o) && o.id === a)return n.push(o), n
                } else {
                    if (l[2])return Q.apply(n, t.getElementsByTagName(e)), n;
                    if ((a = l[3]) && C.getElementsByClassName && t.getElementsByClassName)return Q.apply(n, t.getElementsByClassName(a)), n
                }
                if (C.qsa && !G[e + " "] && (!N || !N.test(e))) {
                    if (1 !== h)u = t, c = e; else if ("object" !== t.nodeName.toLowerCase()) {
                        for ((s = t.getAttribute("id")) ? s = s.replace(be, Ce) : t.setAttribute("id", s = R), d = E(e), r = d.length; r--;)d[r] = "#" + s + " " + f(d[r]);
                        c = d.join(","), u = ye.test(e) && p(t.parentNode) || t
                    }
                    if (c)try {
                        return Q.apply(n, u.querySelectorAll(c)), n
                    } catch (m) {
                    } finally {
                        s === R && t.removeAttribute("id")
                    }
                }
            }
            return z(e.replace(se, "$1"), t, n, i)
        }

        function n() {
            function e(n, i) {
                return t.push(n + " ") > T.cacheLength && delete e[t.shift()], e[n + " "] = i
            }

            var t = [];
            return e
        }

        function i(e) {
            return e[R] = !0, e
        }

        function a(e) {
            var t = H.createElement("fieldset");
            try {
                return !!e(t)
            } catch (n) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null
            }
        }

        function r(e, t) {
            for (var n = e.split("|"), i = n.length; i--;)T.attrHandle[n[i]] = t
        }

        function o(e, t) {
            var n = t && e, i = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
            if (i)return i;
            if (n)for (; n = n.nextSibling;)if (n === t)return -1;
            return e ? 1 : -1
        }

        function s(e) {
            return function (t) {
                var n = t.nodeName.toLowerCase();
                return "input" === n && t.type === e
            }
        }

        function l(e) {
            return function (t) {
                var n = t.nodeName.toLowerCase();
                return ("input" === n || "button" === n) && t.type === e
            }
        }

        function d(e) {
            return function (t) {
                return "form" in t ? t.parentNode && t.disabled === !1 ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === e : t.disabled === e : t.isDisabled === e || t.isDisabled !== !e && Se(t) === e : t.disabled === e : "label" in t && t.disabled === e
            }
        }

        function c(e) {
            return i(function (t) {
                return t = +t, i(function (n, i) {
                    for (var a, r = e([], n.length, t), o = r.length; o--;)n[a = r[o]] && (n[a] = !(i[a] = n[a]))
                })
            })
        }

        function p(e) {
            return e && "undefined" != typeof e.getElementsByTagName && e
        }

        function u() {
        }

        function f(e) {
            for (var t = 0, n = e.length, i = ""; t < n; t++)i += e[t].value;
            return i
        }

        function h(e, t, n) {
            var i = t.dir, a = t.next, r = a || i, o = n && "parentNode" === r, s = F++;
            return t.first ? function (t, n, a) {
                for (; t = t[i];)if (1 === t.nodeType || o)return e(t, n, a);
                return !1
            } : function (t, n, l) {
                var d, c, p, u = [_, s];
                if (l) {
                    for (; t = t[i];)if ((1 === t.nodeType || o) && e(t, n, l))return !0
                } else for (; t = t[i];)if (1 === t.nodeType || o)if (p = t[R] || (t[R] = {}), c = p[t.uniqueID] || (p[t.uniqueID] = {}), a && a === t.nodeName.toLowerCase())t = t[i] || t; else {
                    if ((d = c[r]) && d[0] === _ && d[1] === s)return u[2] = d[2];
                    if (c[r] = u, u[2] = e(t, n, l))return !0
                }
                return !1
            }
        }

        function m(e) {
            return e.length > 1 ? function (t, n, i) {
                for (var a = e.length; a--;)if (!e[a](t, n, i))return !1;
                return !0
            } : e[0]
        }

        function g(e, n, i) {
            for (var a = 0, r = n.length; a < r; a++)t(e, n[a], i);
            return i
        }

        function v(e, t, n, i, a) {
            for (var r, o = [], s = 0, l = e.length, d = null != t; s < l; s++)(r = e[s]) && (n && !n(r, i, a) || (o.push(r), d && t.push(s)));
            return o
        }

        function y(e, t, n, a, r, o) {
            return a && !a[R] && (a = y(a)), r && !r[R] && (r = y(r, o)), i(function (i, o, s, l) {
                var d, c, p, u = [], f = [], h = o.length, m = i || g(t || "*", s.nodeType ? [s] : s, []), y = !e || !i && t ? m : v(m, u, e, s, l), w = n ? r || (i ? e : h || a) ? [] : o : y;
                if (n && n(y, w, s, l), a)for (d = v(w, f), a(d, [], s, l), c = d.length; c--;)(p = d[c]) && (w[f[c]] = !(y[f[c]] = p));
                if (i) {
                    if (r || e) {
                        if (r) {
                            for (d = [], c = w.length; c--;)(p = w[c]) && d.push(y[c] = p);
                            r(null, w = [], d, l)
                        }
                        for (c = w.length; c--;)(p = w[c]) && (d = r ? ee(i, p) : u[c]) > -1 && (i[d] = !(o[d] = p))
                    }
                } else w = v(w === o ? w.splice(h, w.length) : w), r ? r(null, o, w, l) : Q.apply(o, w)
            })
        }

        function w(e) {
            for (var t, n, i, a = e.length, r = T.relative[e[0].type], o = r || T.relative[" "], s = r ? 1 : 0, l = h(function (e) {
                return e === t
            }, o, !0), d = h(function (e) {
                return ee(t, e) > -1
            }, o, !0), c = [function (e, n, i) {
                var a = !r && (i || n !== P) || ((t = n).nodeType ? l(e, n, i) : d(e, n, i));
                return t = null, a
            }]; s < a; s++)if (n = T.relative[e[s].type])c = [h(m(c), n)]; else {
                if (n = T.filter[e[s].type].apply(null, e[s].matches), n[R]) {
                    for (i = ++s; i < a && !T.relative[e[i].type]; i++);
                    return y(s > 1 && m(c), s > 1 && f(e.slice(0, s - 1).concat({value: " " === e[s - 2].type ? "*" : ""})).replace(se, "$1"), n, s < i && w(e.slice(s, i)), i < a && w(e = e.slice(i)), i < a && f(e))
                }
                c.push(n)
            }
            return m(c)
        }

        function x(e, n) {
            var a = n.length > 0, r = e.length > 0, o = function (i, o, s, l, d) {
                var c, p, u, f = 0, h = "0", m = i && [], g = [], y = P, w = i || r && T.find.TAG("*", d), x = _ += null == y ? 1 : Math.random() || .1, b = w.length;
                for (d && (P = o === H || o || d); h !== b && null != (c = w[h]); h++) {
                    if (r && c) {
                        for (p = 0, o || c.ownerDocument === H || (A(c), s = !j); u = e[p++];)if (u(c, o || H, s)) {
                            l.push(c);
                            break
                        }
                        d && (_ = x)
                    }
                    a && ((c = !u && c) && f--, i && m.push(c))
                }
                if (f += h, a && h !== f) {
                    for (p = 0; u = n[p++];)u(m, g, o, s);
                    if (i) {
                        if (f > 0)for (; h--;)m[h] || g[h] || (g[h] = U.call(l));
                        g = v(g)
                    }
                    Q.apply(l, g), d && !i && g.length > 0 && f + n.length > 1 && t.uniqueSort(l)
                }
                return d && (_ = x, P = y), m
            };
            return a ? i(o) : o
        }

        var b, C, T, S, k, E, M, z, P, D, L, A, H, I, j, N, O, q, W, R = "sizzle" + 1 * new Date, B = e.document, _ = 0, F = 0, X = n(), Y = n(), G = n(), V = function (e, t) {
            return e === t && (L = !0), 0
        }, $ = {}.hasOwnProperty, K = [], U = K.pop, Z = K.push, Q = K.push, J = K.slice, ee = function (e, t) {
            for (var n = 0, i = e.length; n < i; n++)if (e[n] === t)return n;
            return -1
        }, te = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", ne = "[\\x20\\t\\r\\n\\f]", ie = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+", ae = "\\[" + ne + "*(" + ie + ")(?:" + ne + "*([*^$|!~]?=)" + ne + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + ie + "))|)" + ne + "*\\]", re = ":(" + ie + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + ae + ")*)|.*)\\)|)", oe = new RegExp(ne + "+", "g"), se = new RegExp("^" + ne + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ne + "+$", "g"), le = new RegExp("^" + ne + "*," + ne + "*"), de = new RegExp("^" + ne + "*([>+~]|" + ne + ")" + ne + "*"), ce = new RegExp("=" + ne + "*([^\\]'\"]*?)" + ne + "*\\]", "g"), pe = new RegExp(re), ue = new RegExp("^" + ie + "$"), fe = {
            ID: new RegExp("^#(" + ie + ")"),
            CLASS: new RegExp("^\\.(" + ie + ")"),
            TAG: new RegExp("^(" + ie + "|[*])"),
            ATTR: new RegExp("^" + ae),
            PSEUDO: new RegExp("^" + re),
            CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ne + "*(even|odd|(([+-]|)(\\d*)n|)" + ne + "*(?:([+-]|)" + ne + "*(\\d+)|))" + ne + "*\\)|)", "i"),
            bool: new RegExp("^(?:" + te + ")$", "i"),
            needsContext: new RegExp("^" + ne + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ne + "*((?:-\\d)?\\d*)" + ne + "*\\)|)(?=[^-]|$)", "i")
        }, he = /^(?:input|select|textarea|button)$/i, me = /^h\d$/i, ge = /^[^{]+\{\s*\[native \w/, ve = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, ye = /[+~]/, we = new RegExp("\\\\([\\da-f]{1,6}" + ne + "?|(" + ne + ")|.)", "ig"), xe = function (e, t, n) {
            var i = "0x" + t - 65536;
            return i !== i || n ? t : i < 0 ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
        }, be = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g, Ce = function (e, t) {
            return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
        }, Te = function () {
            A()
        }, Se = h(function (e) {
            return e.disabled === !0 && ("form" in e || "label" in e)
        }, {dir: "parentNode", next: "legend"});
        try {
            Q.apply(K = J.call(B.childNodes), B.childNodes), K[B.childNodes.length].nodeType
        } catch (ke) {
            Q = {
                apply: K.length ? function (e, t) {
                    Z.apply(e, J.call(t))
                } : function (e, t) {
                    for (var n = e.length, i = 0; e[n++] = t[i++];);
                    e.length = n - 1
                }
            }
        }
        C = t.support = {}, k = t.isXML = function (e) {
            var t = e && (e.ownerDocument || e).documentElement;
            return !!t && "HTML" !== t.nodeName
        }, A = t.setDocument = function (e) {
            var t, n, i = e ? e.ownerDocument || e : B;
            return i !== H && 9 === i.nodeType && i.documentElement ? (H = i, I = H.documentElement, j = !k(H), B !== H && (n = H.defaultView) && n.top !== n && (n.addEventListener ? n.addEventListener("unload", Te, !1) : n.attachEvent && n.attachEvent("onunload", Te)), C.attributes = a(function (e) {
                return e.className = "i", !e.getAttribute("className")
            }), C.getElementsByTagName = a(function (e) {
                return e.appendChild(H.createComment("")), !e.getElementsByTagName("*").length
            }), C.getElementsByClassName = ge.test(H.getElementsByClassName), C.getById = a(function (e) {
                return I.appendChild(e).id = R, !H.getElementsByName || !H.getElementsByName(R).length
            }), C.getById ? (T.filter.ID = function (e) {
                var t = e.replace(we, xe);
                return function (e) {
                    return e.getAttribute("id") === t
                }
            }, T.find.ID = function (e, t) {
                if ("undefined" != typeof t.getElementById && j) {
                    var n = t.getElementById(e);
                    return n ? [n] : []
                }
            }) : (T.filter.ID = function (e) {
                var t = e.replace(we, xe);
                return function (e) {
                    var n = "undefined" != typeof e.getAttributeNode && e.getAttributeNode("id");
                    return n && n.value === t
                }
            }, T.find.ID = function (e, t) {
                if ("undefined" != typeof t.getElementById && j) {
                    var n, i, a, r = t.getElementById(e);
                    if (r) {
                        if (n = r.getAttributeNode("id"), n && n.value === e)return [r];
                        for (a = t.getElementsByName(e), i = 0; r = a[i++];)if (n = r.getAttributeNode("id"), n && n.value === e)return [r]
                    }
                    return []
                }
            }), T.find.TAG = C.getElementsByTagName ? function (e, t) {
                return "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(e) : C.qsa ? t.querySelectorAll(e) : void 0
            } : function (e, t) {
                var n, i = [], a = 0, r = t.getElementsByTagName(e);
                if ("*" === e) {
                    for (; n = r[a++];)1 === n.nodeType && i.push(n);
                    return i
                }
                return r
            }, T.find.CLASS = C.getElementsByClassName && function (e, t) {
                    if ("undefined" != typeof t.getElementsByClassName && j)return t.getElementsByClassName(e)
                }, O = [], N = [], (C.qsa = ge.test(H.querySelectorAll)) && (a(function (e) {
                I.appendChild(e).innerHTML = "<a id='" + R + "'></a><select id='" + R + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && N.push("[*^$]=" + ne + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || N.push("\\[" + ne + "*(?:value|" + te + ")"), e.querySelectorAll("[id~=" + R + "-]").length || N.push("~="), e.querySelectorAll(":checked").length || N.push(":checked"), e.querySelectorAll("a#" + R + "+*").length || N.push(".#.+[+~]")
            }), a(function (e) {
                e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                var t = H.createElement("input");
                t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && N.push("name" + ne + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && N.push(":enabled", ":disabled"), I.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && N.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), N.push(",.*:")
            })), (C.matchesSelector = ge.test(q = I.matches || I.webkitMatchesSelector || I.mozMatchesSelector || I.oMatchesSelector || I.msMatchesSelector)) && a(function (e) {
                C.disconnectedMatch = q.call(e, "*"), q.call(e, "[s!='']:x"), O.push("!=", re)
            }), N = N.length && new RegExp(N.join("|")), O = O.length && new RegExp(O.join("|")), t = ge.test(I.compareDocumentPosition), W = t || ge.test(I.contains) ? function (e, t) {
                var n = 9 === e.nodeType ? e.documentElement : e, i = t && t.parentNode;
                return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)))
            } : function (e, t) {
                if (t)for (; t = t.parentNode;)if (t === e)return !0;
                return !1
            }, V = t ? function (e, t) {
                if (e === t)return L = !0, 0;
                var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
                return n ? n : (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1, 1 & n || !C.sortDetached && t.compareDocumentPosition(e) === n ? e === H || e.ownerDocument === B && W(B, e) ? -1 : t === H || t.ownerDocument === B && W(B, t) ? 1 : D ? ee(D, e) - ee(D, t) : 0 : 4 & n ? -1 : 1)
            } : function (e, t) {
                if (e === t)return L = !0, 0;
                var n, i = 0, a = e.parentNode, r = t.parentNode, s = [e], l = [t];
                if (!a || !r)return e === H ? -1 : t === H ? 1 : a ? -1 : r ? 1 : D ? ee(D, e) - ee(D, t) : 0;
                if (a === r)return o(e, t);
                for (n = e; n = n.parentNode;)s.unshift(n);
                for (n = t; n = n.parentNode;)l.unshift(n);
                for (; s[i] === l[i];)i++;
                return i ? o(s[i], l[i]) : s[i] === B ? -1 : l[i] === B ? 1 : 0
            }, H) : H
        }, t.matches = function (e, n) {
            return t(e, null, null, n)
        }, t.matchesSelector = function (e, n) {
            if ((e.ownerDocument || e) !== H && A(e), n = n.replace(ce, "='$1']"), C.matchesSelector && j && !G[n + " "] && (!O || !O.test(n)) && (!N || !N.test(n)))try {
                var i = q.call(e, n);
                if (i || C.disconnectedMatch || e.document && 11 !== e.document.nodeType)return i
            } catch (a) {
            }
            return t(n, H, null, [e]).length > 0
        }, t.contains = function (e, t) {
            return (e.ownerDocument || e) !== H && A(e), W(e, t)
        }, t.attr = function (e, t) {
            (e.ownerDocument || e) !== H && A(e);
            var n = T.attrHandle[t.toLowerCase()], i = n && $.call(T.attrHandle, t.toLowerCase()) ? n(e, t, !j) : void 0;
            return void 0 !== i ? i : C.attributes || !j ? e.getAttribute(t) : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
        }, t.escape = function (e) {
            return (e + "").replace(be, Ce)
        }, t.error = function (e) {
            throw new Error("Syntax error, unrecognized expression: " + e)
        }, t.uniqueSort = function (e) {
            var t, n = [], i = 0, a = 0;
            if (L = !C.detectDuplicates, D = !C.sortStable && e.slice(0), e.sort(V), L) {
                for (; t = e[a++];)t === e[a] && (i = n.push(a));
                for (; i--;)e.splice(n[i], 1)
            }
            return D = null, e
        }, S = t.getText = function (e) {
            var t, n = "", i = 0, a = e.nodeType;
            if (a) {
                if (1 === a || 9 === a || 11 === a) {
                    if ("string" == typeof e.textContent)return e.textContent;
                    for (e = e.firstChild; e; e = e.nextSibling)n += S(e)
                } else if (3 === a || 4 === a)return e.nodeValue
            } else for (; t = e[i++];)n += S(t);
            return n
        }, T = t.selectors = {
            cacheLength: 50,
            createPseudo: i,
            match: fe,
            attrHandle: {},
            find: {},
            relative: {
                ">": {dir: "parentNode", first: !0},
                " ": {dir: "parentNode"},
                "+": {dir: "previousSibling", first: !0},
                "~": {dir: "previousSibling"}
            },
            preFilter: {
                ATTR: function (e) {
                    return e[1] = e[1].replace(we, xe), e[3] = (e[3] || e[4] || e[5] || "").replace(we, xe), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                }, CHILD: function (e) {
                    return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || t.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && t.error(e[0]), e
                }, PSEUDO: function (e) {
                    var t, n = !e[6] && e[2];
                    return fe.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && pe.test(n) && (t = E(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                }
            },
            filter: {
                TAG: function (e) {
                    var t = e.replace(we, xe).toLowerCase();
                    return "*" === e ? function () {
                        return !0
                    } : function (e) {
                        return e.nodeName && e.nodeName.toLowerCase() === t
                    }
                }, CLASS: function (e) {
                    var t = X[e + " "];
                    return t || (t = new RegExp("(^|" + ne + ")" + e + "(" + ne + "|$)")) && X(e, function (e) {
                            return t.test("string" == typeof e.className && e.className || "undefined" != typeof e.getAttribute && e.getAttribute("class") || "")
                        })
                }, ATTR: function (e, n, i) {
                    return function (a) {
                        var r = t.attr(a, e);
                        return null == r ? "!=" === n : !n || (r += "", "=" === n ? r === i : "!=" === n ? r !== i : "^=" === n ? i && 0 === r.indexOf(i) : "*=" === n ? i && r.indexOf(i) > -1 : "$=" === n ? i && r.slice(-i.length) === i : "~=" === n ? (" " + r.replace(oe, " ") + " ").indexOf(i) > -1 : "|=" === n && (r === i || r.slice(0, i.length + 1) === i + "-"))
                    }
                }, CHILD: function (e, t, n, i, a) {
                    var r = "nth" !== e.slice(0, 3), o = "last" !== e.slice(-4), s = "of-type" === t;
                    return 1 === i && 0 === a ? function (e) {
                        return !!e.parentNode
                    } : function (t, n, l) {
                        var d, c, p, u, f, h, m = r !== o ? "nextSibling" : "previousSibling", g = t.parentNode, v = s && t.nodeName.toLowerCase(), y = !l && !s, w = !1;
                        if (g) {
                            if (r) {
                                for (; m;) {
                                    for (u = t; u = u[m];)if (s ? u.nodeName.toLowerCase() === v : 1 === u.nodeType)return !1;
                                    h = m = "only" === e && !h && "nextSibling"
                                }
                                return !0
                            }
                            if (h = [o ? g.firstChild : g.lastChild], o && y) {
                                for (u = g, p = u[R] || (u[R] = {}), c = p[u.uniqueID] || (p[u.uniqueID] = {}), d = c[e] || [], f = d[0] === _ && d[1], w = f && d[2], u = f && g.childNodes[f]; u = ++f && u && u[m] || (w = f = 0) || h.pop();)if (1 === u.nodeType && ++w && u === t) {
                                    c[e] = [_, f, w];
                                    break
                                }
                            } else if (y && (u = t, p = u[R] || (u[R] = {}), c = p[u.uniqueID] || (p[u.uniqueID] = {}), d = c[e] || [], f = d[0] === _ && d[1], w = f), w === !1)for (; (u = ++f && u && u[m] || (w = f = 0) || h.pop()) && ((s ? u.nodeName.toLowerCase() !== v : 1 !== u.nodeType) || !++w || (y && (p = u[R] || (u[R] = {}), c = p[u.uniqueID] || (p[u.uniqueID] = {}), c[e] = [_, w]), u !== t)););
                            return w -= a, w === i || w % i === 0 && w / i >= 0
                        }
                    }
                }, PSEUDO: function (e, n) {
                    var a, r = T.pseudos[e] || T.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
                    return r[R] ? r(n) : r.length > 1 ? (a = [e, e, "", n], T.setFilters.hasOwnProperty(e.toLowerCase()) ? i(function (e, t) {
                        for (var i, a = r(e, n), o = a.length; o--;)i = ee(e, a[o]), e[i] = !(t[i] = a[o])
                    }) : function (e) {
                        return r(e, 0, a)
                    }) : r
                }
            },
            pseudos: {
                not: i(function (e) {
                    var t = [], n = [], a = M(e.replace(se, "$1"));
                    return a[R] ? i(function (e, t, n, i) {
                        for (var r, o = a(e, null, i, []), s = e.length; s--;)(r = o[s]) && (e[s] = !(t[s] = r))
                    }) : function (e, i, r) {
                        return t[0] = e, a(t, null, r, n), t[0] = null, !n.pop()
                    }
                }), has: i(function (e) {
                    return function (n) {
                        return t(e, n).length > 0
                    }
                }), contains: i(function (e) {
                    return e = e.replace(we, xe), function (t) {
                        return (t.textContent || t.innerText || S(t)).indexOf(e) > -1
                    }
                }), lang: i(function (e) {
                    return ue.test(e || "") || t.error("unsupported lang: " + e), e = e.replace(we, xe).toLowerCase(), function (t) {
                        var n;
                        do if (n = j ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang"))return n = n.toLowerCase(), n === e || 0 === n.indexOf(e + "-"); while ((t = t.parentNode) && 1 === t.nodeType);
                        return !1;
                    }
                }), target: function (t) {
                    var n = e.location && e.location.hash;
                    return n && n.slice(1) === t.id
                }, root: function (e) {
                    return e === I
                }, focus: function (e) {
                    return e === H.activeElement && (!H.hasFocus || H.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                }, enabled: d(!1), disabled: d(!0), checked: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && !!e.checked || "option" === t && !!e.selected
                }, selected: function (e) {
                    return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
                }, empty: function (e) {
                    for (e = e.firstChild; e; e = e.nextSibling)if (e.nodeType < 6)return !1;
                    return !0
                }, parent: function (e) {
                    return !T.pseudos.empty(e)
                }, header: function (e) {
                    return me.test(e.nodeName)
                }, input: function (e) {
                    return he.test(e.nodeName)
                }, button: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && "button" === e.type || "button" === t
                }, text: function (e) {
                    var t;
                    return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                }, first: c(function () {
                    return [0]
                }), last: c(function (e, t) {
                    return [t - 1]
                }), eq: c(function (e, t, n) {
                    return [n < 0 ? n + t : n]
                }), even: c(function (e, t) {
                    for (var n = 0; n < t; n += 2)e.push(n);
                    return e
                }), odd: c(function (e, t) {
                    for (var n = 1; n < t; n += 2)e.push(n);
                    return e
                }), lt: c(function (e, t, n) {
                    for (var i = n < 0 ? n + t : n; --i >= 0;)e.push(i);
                    return e
                }), gt: c(function (e, t, n) {
                    for (var i = n < 0 ? n + t : n; ++i < t;)e.push(i);
                    return e
                })
            }
        }, T.pseudos.nth = T.pseudos.eq;
        for (b in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0})T.pseudos[b] = s(b);
        for (b in{submit: !0, reset: !0})T.pseudos[b] = l(b);
        return u.prototype = T.filters = T.pseudos, T.setFilters = new u, E = t.tokenize = function (e, n) {
            var i, a, r, o, s, l, d, c = Y[e + " "];
            if (c)return n ? 0 : c.slice(0);
            for (s = e, l = [], d = T.preFilter; s;) {
                i && !(a = le.exec(s)) || (a && (s = s.slice(a[0].length) || s), l.push(r = [])), i = !1, (a = de.exec(s)) && (i = a.shift(), r.push({
                    value: i,
                    type: a[0].replace(se, " ")
                }), s = s.slice(i.length));
                for (o in T.filter)!(a = fe[o].exec(s)) || d[o] && !(a = d[o](a)) || (i = a.shift(), r.push({
                    value: i,
                    type: o,
                    matches: a
                }), s = s.slice(i.length));
                if (!i)break
            }
            return n ? s.length : s ? t.error(e) : Y(e, l).slice(0)
        }, M = t.compile = function (e, t) {
            var n, i = [], a = [], r = G[e + " "];
            if (!r) {
                for (t || (t = E(e)), n = t.length; n--;)r = w(t[n]), r[R] ? i.push(r) : a.push(r);
                r = G(e, x(a, i)), r.selector = e
            }
            return r
        }, z = t.select = function (e, t, n, i) {
            var a, r, o, s, l, d = "function" == typeof e && e, c = !i && E(e = d.selector || e);
            if (n = n || [], 1 === c.length) {
                if (r = c[0] = c[0].slice(0), r.length > 2 && "ID" === (o = r[0]).type && 9 === t.nodeType && j && T.relative[r[1].type]) {
                    if (t = (T.find.ID(o.matches[0].replace(we, xe), t) || [])[0], !t)return n;
                    d && (t = t.parentNode), e = e.slice(r.shift().value.length)
                }
                for (a = fe.needsContext.test(e) ? 0 : r.length; a-- && (o = r[a], !T.relative[s = o.type]);)if ((l = T.find[s]) && (i = l(o.matches[0].replace(we, xe), ye.test(r[0].type) && p(t.parentNode) || t))) {
                    if (r.splice(a, 1), e = i.length && f(r), !e)return Q.apply(n, i), n;
                    break
                }
            }
            return (d || M(e, c))(i, t, !j, n, !t || ye.test(e) && p(t.parentNode) || t), n
        }, C.sortStable = R.split("").sort(V).join("") === R, C.detectDuplicates = !!L, A(), C.sortDetached = a(function (e) {
            return 1 & e.compareDocumentPosition(H.createElement("fieldset"))
        }), a(function (e) {
            return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
        }) || r("type|href|height|width", function (e, t, n) {
            if (!n)return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), C.attributes && a(function (e) {
            return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
        }) || r("value", function (e, t, n) {
            if (!n && "input" === e.nodeName.toLowerCase())return e.defaultValue
        }), a(function (e) {
            return null == e.getAttribute("disabled")
        }) || r(te, function (e, t, n) {
            var i;
            if (!n)return e[t] === !0 ? t.toLowerCase() : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
        }), t
    }(e);
    he.find = we, he.expr = we.selectors, he.expr[":"] = he.expr.pseudos, he.uniqueSort = he.unique = we.uniqueSort, he.text = we.getText, he.isXMLDoc = we.isXML, he.contains = we.contains, he.escapeSelector = we.escape;
    var xe = function (e, t, n) {
        for (var i = [], a = void 0 !== n; (e = e[t]) && 9 !== e.nodeType;)if (1 === e.nodeType) {
            if (a && he(e).is(n))break;
            i.push(e)
        }
        return i
    }, be = function (e, t) {
        for (var n = []; e; e = e.nextSibling)1 === e.nodeType && e !== t && n.push(e);
        return n
    }, Ce = he.expr.match.needsContext, Te = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i, Se = /^.[^:#\[\.,]*$/;
    he.filter = function (e, t, n) {
        var i = t[0];
        return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === i.nodeType ? he.find.matchesSelector(i, e) ? [i] : [] : he.find.matches(e, he.grep(t, function (e) {
            return 1 === e.nodeType
        }))
    }, he.fn.extend({
        find: function (e) {
            var t, n, i = this.length, a = this;
            if ("string" != typeof e)return this.pushStack(he(e).filter(function () {
                for (t = 0; t < i; t++)if (he.contains(a[t], this))return !0
            }));
            for (n = this.pushStack([]), t = 0; t < i; t++)he.find(e, a[t], n);
            return i > 1 ? he.uniqueSort(n) : n
        }, filter: function (e) {
            return this.pushStack(a(this, e || [], !1))
        }, not: function (e) {
            return this.pushStack(a(this, e || [], !0))
        }, is: function (e) {
            return !!a(this, "string" == typeof e && Ce.test(e) ? he(e) : e || [], !1).length
        }
    });
    var ke, Ee = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/, Me = he.fn.init = function (e, t, n) {
        var i, a;
        if (!e)return this;
        if (n = n || ke, "string" == typeof e) {
            if (i = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : Ee.exec(e), !i || !i[1] && t)return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
            if (i[1]) {
                if (t = t instanceof he ? t[0] : t, he.merge(this, he.parseHTML(i[1], t && t.nodeType ? t.ownerDocument || t : te, !0)), Te.test(i[1]) && he.isPlainObject(t))for (i in t)he.isFunction(this[i]) ? this[i](t[i]) : this.attr(i, t[i]);
                return this
            }
            return a = te.getElementById(i[2]), a && (this[0] = a, this.length = 1), this
        }
        return e.nodeType ? (this[0] = e, this.length = 1, this) : he.isFunction(e) ? void 0 !== n.ready ? n.ready(e) : e(he) : he.makeArray(e, this)
    };
    Me.prototype = he.fn, ke = he(te);
    var ze = /^(?:parents|prev(?:Until|All))/, Pe = {children: !0, contents: !0, next: !0, prev: !0};
    he.fn.extend({
        has: function (e) {
            var t = he(e, this), n = t.length;
            return this.filter(function () {
                for (var e = 0; e < n; e++)if (he.contains(this, t[e]))return !0
            })
        }, closest: function (e, t) {
            var n, i = 0, a = this.length, r = [], o = "string" != typeof e && he(e);
            if (!Ce.test(e))for (; i < a; i++)for (n = this[i]; n && n !== t; n = n.parentNode)if (n.nodeType < 11 && (o ? o.index(n) > -1 : 1 === n.nodeType && he.find.matchesSelector(n, e))) {
                r.push(n);
                break
            }
            return this.pushStack(r.length > 1 ? he.uniqueSort(r) : r)
        }, index: function (e) {
            return e ? "string" == typeof e ? oe.call(he(e), this[0]) : oe.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        }, add: function (e, t) {
            return this.pushStack(he.uniqueSort(he.merge(this.get(), he(e, t))))
        }, addBack: function (e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), he.each({
        parent: function (e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        }, parents: function (e) {
            return xe(e, "parentNode")
        }, parentsUntil: function (e, t, n) {
            return xe(e, "parentNode", n)
        }, next: function (e) {
            return r(e, "nextSibling")
        }, prev: function (e) {
            return r(e, "previousSibling")
        }, nextAll: function (e) {
            return xe(e, "nextSibling")
        }, prevAll: function (e) {
            return xe(e, "previousSibling")
        }, nextUntil: function (e, t, n) {
            return xe(e, "nextSibling", n)
        }, prevUntil: function (e, t, n) {
            return xe(e, "previousSibling", n)
        }, siblings: function (e) {
            return be((e.parentNode || {}).firstChild, e)
        }, children: function (e) {
            return be(e.firstChild)
        }, contents: function (e) {
            return e.contentDocument || he.merge([], e.childNodes)
        }
    }, function (e, t) {
        he.fn[e] = function (n, i) {
            var a = he.map(this, t, n);
            return "Until" !== e.slice(-5) && (i = n), i && "string" == typeof i && (a = he.filter(i, a)), this.length > 1 && (Pe[e] || he.uniqueSort(a), ze.test(e) && a.reverse()), this.pushStack(a)
        }
    });
    var De = /[^\x20\t\r\n\f]+/g;
    he.Callbacks = function (e) {
        e = "string" == typeof e ? o(e) : he.extend({}, e);
        var t, n, i, a, r = [], s = [], l = -1, d = function () {
            for (a = e.once, i = t = !0; s.length; l = -1)for (n = s.shift(); ++l < r.length;)r[l].apply(n[0], n[1]) === !1 && e.stopOnFalse && (l = r.length, n = !1);
            e.memory || (n = !1), t = !1, a && (r = n ? [] : "")
        }, c = {
            add: function () {
                return r && (n && !t && (l = r.length - 1, s.push(n)), function i(t) {
                    he.each(t, function (t, n) {
                        he.isFunction(n) ? e.unique && c.has(n) || r.push(n) : n && n.length && "string" !== he.type(n) && i(n)
                    })
                }(arguments), n && !t && d()), this
            }, remove: function () {
                return he.each(arguments, function (e, t) {
                    for (var n; (n = he.inArray(t, r, n)) > -1;)r.splice(n, 1), n <= l && l--
                }), this
            }, has: function (e) {
                return e ? he.inArray(e, r) > -1 : r.length > 0
            }, empty: function () {
                return r && (r = []), this
            }, disable: function () {
                return a = s = [], r = n = "", this
            }, disabled: function () {
                return !r
            }, lock: function () {
                return a = s = [], n || t || (r = n = ""), this
            }, locked: function () {
                return !!a
            }, fireWith: function (e, n) {
                return a || (n = n || [], n = [e, n.slice ? n.slice() : n], s.push(n), t || d()), this
            }, fire: function () {
                return c.fireWith(this, arguments), this
            }, fired: function () {
                return !!i
            }
        };
        return c
    }, he.extend({
        Deferred: function (t) {
            var n = [["notify", "progress", he.Callbacks("memory"), he.Callbacks("memory"), 2], ["resolve", "done", he.Callbacks("once memory"), he.Callbacks("once memory"), 0, "resolved"], ["reject", "fail", he.Callbacks("once memory"), he.Callbacks("once memory"), 1, "rejected"]], i = "pending", a = {
                state: function () {
                    return i
                }, always: function () {
                    return r.done(arguments).fail(arguments), this
                }, "catch": function (e) {
                    return a.then(null, e)
                }, pipe: function () {
                    var e = arguments;
                    return he.Deferred(function (t) {
                        he.each(n, function (n, i) {
                            var a = he.isFunction(e[i[4]]) && e[i[4]];
                            r[i[1]](function () {
                                var e = a && a.apply(this, arguments);
                                e && he.isFunction(e.promise) ? e.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[i[0] + "With"](this, a ? [e] : arguments)
                            })
                        }), e = null
                    }).promise()
                }, then: function (t, i, a) {
                    function r(t, n, i, a) {
                        return function () {
                            var d = this, c = arguments, p = function () {
                                var e, p;
                                if (!(t < o)) {
                                    if (e = i.apply(d, c), e === n.promise())throw new TypeError("Thenable self-resolution");
                                    p = e && ("object" == typeof e || "function" == typeof e) && e.then, he.isFunction(p) ? a ? p.call(e, r(o, n, s, a), r(o, n, l, a)) : (o++, p.call(e, r(o, n, s, a), r(o, n, l, a), r(o, n, s, n.notifyWith))) : (i !== s && (d = void 0, c = [e]), (a || n.resolveWith)(d, c))
                                }
                            }, u = a ? p : function () {
                                try {
                                    p()
                                } catch (e) {
                                    he.Deferred.exceptionHook && he.Deferred.exceptionHook(e, u.stackTrace), t + 1 >= o && (i !== l && (d = void 0, c = [e]), n.rejectWith(d, c))
                                }
                            };
                            t ? u() : (he.Deferred.getStackHook && (u.stackTrace = he.Deferred.getStackHook()), e.setTimeout(u))
                        }
                    }

                    var o = 0;
                    return he.Deferred(function (e) {
                        n[0][3].add(r(0, e, he.isFunction(a) ? a : s, e.notifyWith)), n[1][3].add(r(0, e, he.isFunction(t) ? t : s)), n[2][3].add(r(0, e, he.isFunction(i) ? i : l))
                    }).promise()
                }, promise: function (e) {
                    return null != e ? he.extend(e, a) : a
                }
            }, r = {};
            return he.each(n, function (e, t) {
                var o = t[2], s = t[5];
                a[t[1]] = o.add, s && o.add(function () {
                    i = s
                }, n[3 - e][2].disable, n[0][2].lock), o.add(t[3].fire), r[t[0]] = function () {
                    return r[t[0] + "With"](this === r ? void 0 : this, arguments), this
                }, r[t[0] + "With"] = o.fireWith
            }), a.promise(r), t && t.call(r, r), r
        }, when: function (e) {
            var t = arguments.length, n = t, i = Array(n), a = ie.call(arguments), r = he.Deferred(), o = function (e) {
                return function (n) {
                    i[e] = this, a[e] = arguments.length > 1 ? ie.call(arguments) : n, --t || r.resolveWith(i, a)
                }
            };
            if (t <= 1 && (d(e, r.done(o(n)).resolve, r.reject), "pending" === r.state() || he.isFunction(a[n] && a[n].then)))return r.then();
            for (; n--;)d(a[n], o(n), r.reject);
            return r.promise()
        }
    });
    var Le = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
    he.Deferred.exceptionHook = function (t, n) {
        e.console && e.console.warn && t && Le.test(t.name) && e.console.warn("jQuery.Deferred exception: " + t.message, t.stack, n)
    }, he.readyException = function (t) {
        e.setTimeout(function () {
            throw t
        })
    };
    var Ae = he.Deferred();
    he.fn.ready = function (e) {
        return Ae.then(e)["catch"](function (e) {
            he.readyException(e)
        }), this
    }, he.extend({
        isReady: !1, readyWait: 1, holdReady: function (e) {
            e ? he.readyWait++ : he.ready(!0)
        }, ready: function (e) {
            (e === !0 ? --he.readyWait : he.isReady) || (he.isReady = !0, e !== !0 && --he.readyWait > 0 || Ae.resolveWith(te, [he]))
        }
    }), he.ready.then = Ae.then, "complete" === te.readyState || "loading" !== te.readyState && !te.documentElement.doScroll ? e.setTimeout(he.ready) : (te.addEventListener("DOMContentLoaded", c), e.addEventListener("load", c));
    var He = function (e, t, n, i, a, r, o) {
        var s = 0, l = e.length, d = null == n;
        if ("object" === he.type(n)) {
            a = !0;
            for (s in n)He(e, t, s, n[s], !0, r, o)
        } else if (void 0 !== i && (a = !0, he.isFunction(i) || (o = !0), d && (o ? (t.call(e, i), t = null) : (d = t, t = function (e, t, n) {
                return d.call(he(e), n)
            })), t))for (; s < l; s++)t(e[s], n, o ? i : i.call(e[s], s, t(e[s], n)));
        return a ? e : d ? t.call(e) : l ? t(e[0], n) : r
    }, Ie = function (e) {
        return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
    };
    p.uid = 1, p.prototype = {
        cache: function (e) {
            var t = e[this.expando];
            return t || (t = {}, Ie(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
                value: t,
                configurable: !0
            }))), t
        }, set: function (e, t, n) {
            var i, a = this.cache(e);
            if ("string" == typeof t)a[he.camelCase(t)] = n; else for (i in t)a[he.camelCase(i)] = t[i];
            return a
        }, get: function (e, t) {
            return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][he.camelCase(t)]
        }, access: function (e, t, n) {
            return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t)
        }, remove: function (e, t) {
            var n, i = e[this.expando];
            if (void 0 !== i) {
                if (void 0 !== t) {
                    he.isArray(t) ? t = t.map(he.camelCase) : (t = he.camelCase(t), t = t in i ? [t] : t.match(De) || []), n = t.length;
                    for (; n--;)delete i[t[n]]
                }
                (void 0 === t || he.isEmptyObject(i)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando])
            }
        }, hasData: function (e) {
            var t = e[this.expando];
            return void 0 !== t && !he.isEmptyObject(t)
        }
    };
    var je = new p, Ne = new p, Oe = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, qe = /[A-Z]/g;
    he.extend({
        hasData: function (e) {
            return Ne.hasData(e) || je.hasData(e)
        }, data: function (e, t, n) {
            return Ne.access(e, t, n)
        }, removeData: function (e, t) {
            Ne.remove(e, t)
        }, _data: function (e, t, n) {
            return je.access(e, t, n)
        }, _removeData: function (e, t) {
            je.remove(e, t)
        }
    }), he.fn.extend({
        data: function (e, t) {
            var n, i, a, r = this[0], o = r && r.attributes;
            if (void 0 === e) {
                if (this.length && (a = Ne.get(r), 1 === r.nodeType && !je.get(r, "hasDataAttrs"))) {
                    for (n = o.length; n--;)o[n] && (i = o[n].name, 0 === i.indexOf("data-") && (i = he.camelCase(i.slice(5)), f(r, i, a[i])));
                    je.set(r, "hasDataAttrs", !0)
                }
                return a
            }
            return "object" == typeof e ? this.each(function () {
                Ne.set(this, e)
            }) : He(this, function (t) {
                var n;
                if (r && void 0 === t) {
                    if (n = Ne.get(r, e), void 0 !== n)return n;
                    if (n = f(r, e), void 0 !== n)return n
                } else this.each(function () {
                    Ne.set(this, e, t)
                })
            }, null, t, arguments.length > 1, null, !0)
        }, removeData: function (e) {
            return this.each(function () {
                Ne.remove(this, e)
            })
        }
    }), he.extend({
        queue: function (e, t, n) {
            var i;
            if (e)return t = (t || "fx") + "queue", i = je.get(e, t), n && (!i || he.isArray(n) ? i = je.access(e, t, he.makeArray(n)) : i.push(n)), i || []
        }, dequeue: function (e, t) {
            t = t || "fx";
            var n = he.queue(e, t), i = n.length, a = n.shift(), r = he._queueHooks(e, t), o = function () {
                he.dequeue(e, t)
            };
            "inprogress" === a && (a = n.shift(), i--), a && ("fx" === t && n.unshift("inprogress"), delete r.stop, a.call(e, o, r)), !i && r && r.empty.fire()
        }, _queueHooks: function (e, t) {
            var n = t + "queueHooks";
            return je.get(e, n) || je.access(e, n, {
                    empty: he.Callbacks("once memory").add(function () {
                        je.remove(e, [t + "queue", n])
                    })
                })
        }
    }), he.fn.extend({
        queue: function (e, t) {
            var n = 2;
            return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? he.queue(this[0], e) : void 0 === t ? this : this.each(function () {
                var n = he.queue(this, e, t);
                he._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && he.dequeue(this, e)
            })
        }, dequeue: function (e) {
            return this.each(function () {
                he.dequeue(this, e)
            })
        }, clearQueue: function (e) {
            return this.queue(e || "fx", [])
        }, promise: function (e, t) {
            var n, i = 1, a = he.Deferred(), r = this, o = this.length, s = function () {
                --i || a.resolveWith(r, [r])
            };
            for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; o--;)n = je.get(r[o], e + "queueHooks"), n && n.empty && (i++, n.empty.add(s));
            return s(), a.promise(t)
        }
    });
    var We = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, Re = new RegExp("^(?:([+-])=|)(" + We + ")([a-z%]*)$", "i"), Be = ["Top", "Right", "Bottom", "Left"], _e = function (e, t) {
        return e = t || e, "none" === e.style.display || "" === e.style.display && he.contains(e.ownerDocument, e) && "none" === he.css(e, "display")
    }, Fe = function (e, t, n, i) {
        var a, r, o = {};
        for (r in t)o[r] = e.style[r], e.style[r] = t[r];
        a = n.apply(e, i || []);
        for (r in t)e.style[r] = o[r];
        return a
    }, Xe = {};
    he.fn.extend({
        show: function () {
            return g(this, !0)
        }, hide: function () {
            return g(this)
        }, toggle: function (e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
                _e(this) ? he(this).show() : he(this).hide()
            })
        }
    });
    var Ye = /^(?:checkbox|radio)$/i, Ge = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i, Ve = /^$|\/(?:java|ecma)script/i, $e = {
        option: [1, "<select multiple='multiple'>", "</select>"],
        thead: [1, "<table>", "</table>"],
        col: [2, "<table><colgroup>", "</colgroup></table>"],
        tr: [2, "<table><tbody>", "</tbody></table>"],
        td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
        _default: [0, "", ""]
    };
    $e.optgroup = $e.option, $e.tbody = $e.tfoot = $e.colgroup = $e.caption = $e.thead, $e.th = $e.td;
    var Ke = /<|&#?\w+;/;
    !function () {
        var e = te.createDocumentFragment(), t = e.appendChild(te.createElement("div")), n = te.createElement("input");
        n.setAttribute("type", "radio"), n.setAttribute("checked", "checked"), n.setAttribute("name", "t"), t.appendChild(n), ue.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, t.innerHTML = "<textarea>x</textarea>", ue.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue
    }();
    var Ue = te.documentElement, Ze = /^key/, Qe = /^(?:mouse|pointer|contextmenu|drag|drop)|click/, Je = /^([^.]*)(?:\.(.+)|)/;
    he.event = {
        global: {}, add: function (e, t, n, i, a) {
            var r, o, s, l, d, c, p, u, f, h, m, g = je.get(e);
            if (g)for (n.handler && (r = n, n = r.handler, a = r.selector), a && he.find.matchesSelector(Ue, a), n.guid || (n.guid = he.guid++), (l = g.events) || (l = g.events = {}), (o = g.handle) || (o = g.handle = function (t) {
                return "undefined" != typeof he && he.event.triggered !== t.type ? he.event.dispatch.apply(e, arguments) : void 0
            }), t = (t || "").match(De) || [""], d = t.length; d--;)s = Je.exec(t[d]) || [], f = m = s[1], h = (s[2] || "").split(".").sort(), f && (p = he.event.special[f] || {}, f = (a ? p.delegateType : p.bindType) || f, p = he.event.special[f] || {}, c = he.extend({
                type: f,
                origType: m,
                data: i,
                handler: n,
                guid: n.guid,
                selector: a,
                needsContext: a && he.expr.match.needsContext.test(a),
                namespace: h.join(".")
            }, r), (u = l[f]) || (u = l[f] = [], u.delegateCount = 0, p.setup && p.setup.call(e, i, h, o) !== !1 || e.addEventListener && e.addEventListener(f, o)), p.add && (p.add.call(e, c), c.handler.guid || (c.handler.guid = n.guid)), a ? u.splice(u.delegateCount++, 0, c) : u.push(c), he.event.global[f] = !0)
        }, remove: function (e, t, n, i, a) {
            var r, o, s, l, d, c, p, u, f, h, m, g = je.hasData(e) && je.get(e);
            if (g && (l = g.events)) {
                for (t = (t || "").match(De) || [""], d = t.length; d--;)if (s = Je.exec(t[d]) || [], f = m = s[1], h = (s[2] || "").split(".").sort(), f) {
                    for (p = he.event.special[f] || {}, f = (i ? p.delegateType : p.bindType) || f, u = l[f] || [], s = s[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), o = r = u.length; r--;)c = u[r], !a && m !== c.origType || n && n.guid !== c.guid || s && !s.test(c.namespace) || i && i !== c.selector && ("**" !== i || !c.selector) || (u.splice(r, 1), c.selector && u.delegateCount--, p.remove && p.remove.call(e, c));
                    o && !u.length && (p.teardown && p.teardown.call(e, h, g.handle) !== !1 || he.removeEvent(e, f, g.handle), delete l[f])
                } else for (f in l)he.event.remove(e, f + t[d], n, i, !0);
                he.isEmptyObject(l) && je.remove(e, "handle events")
            }
        }, dispatch: function (e) {
            var t, n, i, a, r, o, s = he.event.fix(e), l = new Array(arguments.length), d = (je.get(this, "events") || {})[s.type] || [], c = he.event.special[s.type] || {};
            for (l[0] = s, t = 1; t < arguments.length; t++)l[t] = arguments[t];
            if (s.delegateTarget = this, !c.preDispatch || c.preDispatch.call(this, s) !== !1) {
                for (o = he.event.handlers.call(this, s, d), t = 0; (a = o[t++]) && !s.isPropagationStopped();)for (s.currentTarget = a.elem, n = 0; (r = a.handlers[n++]) && !s.isImmediatePropagationStopped();)s.rnamespace && !s.rnamespace.test(r.namespace) || (s.handleObj = r, s.data = r.data, i = ((he.event.special[r.origType] || {}).handle || r.handler).apply(a.elem, l), void 0 !== i && (s.result = i) === !1 && (s.preventDefault(), s.stopPropagation()));
                return c.postDispatch && c.postDispatch.call(this, s), s.result
            }
        }, handlers: function (e, t) {
            var n, i, a, r, o, s = [], l = t.delegateCount, d = e.target;
            if (l && d.nodeType && !("click" === e.type && e.button >= 1))for (; d !== this; d = d.parentNode || this)if (1 === d.nodeType && ("click" !== e.type || d.disabled !== !0)) {
                for (r = [], o = {}, n = 0; n < l; n++)i = t[n], a = i.selector + " ", void 0 === o[a] && (o[a] = i.needsContext ? he(a, this).index(d) > -1 : he.find(a, this, null, [d]).length), o[a] && r.push(i);
                r.length && s.push({elem: d, handlers: r})
            }
            return d = this, l < t.length && s.push({elem: d, handlers: t.slice(l)}), s
        }, addProp: function (e, t) {
            Object.defineProperty(he.Event.prototype, e, {
                enumerable: !0,
                configurable: !0,
                get: he.isFunction(t) ? function () {
                    if (this.originalEvent)return t(this.originalEvent)
                } : function () {
                    if (this.originalEvent)return this.originalEvent[e]
                },
                set: function (t) {
                    Object.defineProperty(this, e, {enumerable: !0, configurable: !0, writable: !0, value: t})
                }
            })
        }, fix: function (e) {
            return e[he.expando] ? e : new he.Event(e)
        }, special: {
            load: {noBubble: !0}, focus: {
                trigger: function () {
                    if (this !== C() && this.focus)return this.focus(), !1
                }, delegateType: "focusin"
            }, blur: {
                trigger: function () {
                    if (this === C() && this.blur)return this.blur(), !1
                }, delegateType: "focusout"
            }, click: {
                trigger: function () {
                    if ("checkbox" === this.type && this.click && he.nodeName(this, "input"))return this.click(), !1
                }, _default: function (e) {
                    return he.nodeName(e.target, "a")
                }
            }, beforeunload: {
                postDispatch: function (e) {
                    void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                }
            }
        }
    }, he.removeEvent = function (e, t, n) {
        e.removeEventListener && e.removeEventListener(t, n)
    }, he.Event = function (e, t) {
        return this instanceof he.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && e.returnValue === !1 ? x : b, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && he.extend(this, t), this.timeStamp = e && e.timeStamp || he.now(), void(this[he.expando] = !0)) : new he.Event(e, t)
    }, he.Event.prototype = {
        constructor: he.Event,
        isDefaultPrevented: b,
        isPropagationStopped: b,
        isImmediatePropagationStopped: b,
        isSimulated: !1,
        preventDefault: function () {
            var e = this.originalEvent;
            this.isDefaultPrevented = x, e && !this.isSimulated && e.preventDefault()
        },
        stopPropagation: function () {
            var e = this.originalEvent;
            this.isPropagationStopped = x, e && !this.isSimulated && e.stopPropagation()
        },
        stopImmediatePropagation: function () {
            var e = this.originalEvent;
            this.isImmediatePropagationStopped = x, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation()
        }
    }, he.each({
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        "char": !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: function (e) {
            var t = e.button;
            return null == e.which && Ze.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && Qe.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which
        }
    }, he.event.addProp), he.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function (e, t) {
        he.event.special[e] = {
            delegateType: t, bindType: t, handle: function (e) {
                var n, i = this, a = e.relatedTarget, r = e.handleObj;
                return a && (a === i || he.contains(i, a)) || (e.type = r.origType, n = r.handler.apply(this, arguments), e.type = t), n
            }
        }
    }), he.fn.extend({
        on: function (e, t, n, i) {
            return T(this, e, t, n, i)
        }, one: function (e, t, n, i) {
            return T(this, e, t, n, i, 1)
        }, off: function (e, t, n) {
            var i, a;
            if (e && e.preventDefault && e.handleObj)return i = e.handleObj, he(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
            if ("object" == typeof e) {
                for (a in e)this.off(a, t, e[a]);
                return this
            }
            return t !== !1 && "function" != typeof t || (n = t, t = void 0), n === !1 && (n = b), this.each(function () {
                he.event.remove(this, e, n, t)
            })
        }
    });
    var et = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi, tt = /<script|<style|<link/i, nt = /checked\s*(?:[^=]|=\s*.checked.)/i, it = /^true\/(.*)/, at = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
    he.extend({
        htmlPrefilter: function (e) {
            return e.replace(et, "<$1></$2>")
        }, clone: function (e, t, n) {
            var i, a, r, o, s = e.cloneNode(!0), l = he.contains(e.ownerDocument, e);
            if (!(ue.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || he.isXMLDoc(e)))for (o = v(s), r = v(e), i = 0, a = r.length; i < a; i++)z(r[i], o[i]);
            if (t)if (n)for (r = r || v(e), o = o || v(s), i = 0, a = r.length; i < a; i++)M(r[i], o[i]); else M(e, s);
            return o = v(s, "script"), o.length > 0 && y(o, !l && v(e, "script")), s
        }, cleanData: function (e) {
            for (var t, n, i, a = he.event.special, r = 0; void 0 !== (n = e[r]); r++)if (Ie(n)) {
                if (t = n[je.expando]) {
                    if (t.events)for (i in t.events)a[i] ? he.event.remove(n, i) : he.removeEvent(n, i, t.handle);
                    n[je.expando] = void 0
                }
                n[Ne.expando] && (n[Ne.expando] = void 0)
            }
        }
    }), he.fn.extend({
        detach: function (e) {
            return D(this, e, !0)
        }, remove: function (e) {
            return D(this, e)
        }, text: function (e) {
            return He(this, function (e) {
                return void 0 === e ? he.text(this) : this.empty().each(function () {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
                })
            }, null, e, arguments.length)
        }, append: function () {
            return P(this, arguments, function (e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = S(this, e);
                    t.appendChild(e)
                }
            })
        }, prepend: function () {
            return P(this, arguments, function (e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = S(this, e);
                    t.insertBefore(e, t.firstChild)
                }
            })
        }, before: function () {
            return P(this, arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        }, after: function () {
            return P(this, arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        }, empty: function () {
            for (var e, t = 0; null != (e = this[t]); t++)1 === e.nodeType && (he.cleanData(v(e, !1)), e.textContent = "");
            return this
        }, clone: function (e, t) {
            return e = null != e && e, t = null == t ? e : t, this.map(function () {
                return he.clone(this, e, t)
            })
        }, html: function (e) {
            return He(this, function (e) {
                var t = this[0] || {}, n = 0, i = this.length;
                if (void 0 === e && 1 === t.nodeType)return t.innerHTML;
                if ("string" == typeof e && !tt.test(e) && !$e[(Ge.exec(e) || ["", ""])[1].toLowerCase()]) {
                    e = he.htmlPrefilter(e);
                    try {
                        for (; n < i; n++)t = this[n] || {}, 1 === t.nodeType && (he.cleanData(v(t, !1)), t.innerHTML = e);
                        t = 0
                    } catch (a) {
                    }
                }
                t && this.empty().append(e)
            }, null, e, arguments.length)
        }, replaceWith: function () {
            var e = [];
            return P(this, arguments, function (t) {
                var n = this.parentNode;
                he.inArray(this, e) < 0 && (he.cleanData(v(this)), n && n.replaceChild(t, this))
            }, e)
        }
    }), he.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (e, t) {
        he.fn[e] = function (e) {
            for (var n, i = [], a = he(e), r = a.length - 1, o = 0; o <= r; o++)n = o === r ? this : this.clone(!0), he(a[o])[t](n), re.apply(i, n.get());
            return this.pushStack(i)
        }
    });
    var rt = /^margin/, ot = new RegExp("^(" + We + ")(?!px)[a-z%]+$", "i"), st = function (t) {
        var n = t.ownerDocument.defaultView;
        return n && n.opener || (n = e), n.getComputedStyle(t)
    };
    !function () {
        function t() {
            if (s) {
                s.style.cssText = "box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%", s.innerHTML = "", Ue.appendChild(o);
                var t = e.getComputedStyle(s);
                n = "1%" !== t.top, r = "2px" === t.marginLeft, i = "4px" === t.width, s.style.marginRight = "50%", a = "4px" === t.marginRight, Ue.removeChild(o), s = null
            }
        }

        var n, i, a, r, o = te.createElement("div"), s = te.createElement("div");
        s.style && (s.style.backgroundClip = "content-box", s.cloneNode(!0).style.backgroundClip = "", ue.clearCloneStyle = "content-box" === s.style.backgroundClip, o.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute", o.appendChild(s), he.extend(ue, {
            pixelPosition: function () {
                return t(), n
            }, boxSizingReliable: function () {
                return t(), i
            }, pixelMarginRight: function () {
                return t(), a
            }, reliableMarginLeft: function () {
                return t(), r
            }
        }))
    }();
    var lt = /^(none|table(?!-c[ea]).+)/, dt = {
        position: "absolute",
        visibility: "hidden",
        display: "block"
    }, ct = {letterSpacing: "0", fontWeight: "400"}, pt = ["Webkit", "Moz", "ms"], ut = te.createElement("div").style;
    he.extend({
        cssHooks: {
            opacity: {
                get: function (e, t) {
                    if (t) {
                        var n = L(e, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {"float": "cssFloat"},
        style: function (e, t, n, i) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var a, r, o, s = he.camelCase(t), l = e.style;
                return t = he.cssProps[s] || (he.cssProps[s] = H(s) || s), o = he.cssHooks[t] || he.cssHooks[s], void 0 === n ? o && "get" in o && void 0 !== (a = o.get(e, !1, i)) ? a : l[t] : (r = typeof n, "string" === r && (a = Re.exec(n)) && a[1] && (n = h(e, t, a), r = "number"), null != n && n === n && ("number" === r && (n += a && a[3] || (he.cssNumber[s] ? "" : "px")), ue.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (l[t] = "inherit"), o && "set" in o && void 0 === (n = o.set(e, n, i)) || (l[t] = n)), void 0)
            }
        },
        css: function (e, t, n, i) {
            var a, r, o, s = he.camelCase(t);
            return t = he.cssProps[s] || (he.cssProps[s] = H(s) || s), o = he.cssHooks[t] || he.cssHooks[s], o && "get" in o && (a = o.get(e, !0, n)), void 0 === a && (a = L(e, t, i)), "normal" === a && t in ct && (a = ct[t]), "" === n || n ? (r = parseFloat(a), n === !0 || isFinite(r) ? r || 0 : a) : a
        }
    }), he.each(["height", "width"], function (e, t) {
        he.cssHooks[t] = {
            get: function (e, n, i) {
                if (n)return !lt.test(he.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? N(e, t, i) : Fe(e, dt, function () {
                    return N(e, t, i)
                })
            }, set: function (e, n, i) {
                var a, r = i && st(e), o = i && j(e, t, i, "border-box" === he.css(e, "boxSizing", !1, r), r);
                return o && (a = Re.exec(n)) && "px" !== (a[3] || "px") && (e.style[t] = n, n = he.css(e, t)), I(e, n, o)
            }
        }
    }), he.cssHooks.marginLeft = A(ue.reliableMarginLeft, function (e, t) {
        if (t)return (parseFloat(L(e, "marginLeft")) || e.getBoundingClientRect().left - Fe(e, {marginLeft: 0}, function () {
                return e.getBoundingClientRect().left
            })) + "px"
    }), he.each({margin: "", padding: "", border: "Width"}, function (e, t) {
        he.cssHooks[e + t] = {
            expand: function (n) {
                for (var i = 0, a = {}, r = "string" == typeof n ? n.split(" ") : [n]; i < 4; i++)a[e + Be[i] + t] = r[i] || r[i - 2] || r[0];
                return a
            }
        }, rt.test(e) || (he.cssHooks[e + t].set = I)
    }), he.fn.extend({
        css: function (e, t) {
            return He(this, function (e, t, n) {
                var i, a, r = {}, o = 0;
                if (he.isArray(t)) {
                    for (i = st(e), a = t.length; o < a; o++)r[t[o]] = he.css(e, t[o], !1, i);
                    return r
                }
                return void 0 !== n ? he.style(e, t, n) : he.css(e, t)
            }, e, t, arguments.length > 1)
        }
    }), he.Tween = O, O.prototype = {
        constructor: O, init: function (e, t, n, i, a, r) {
            this.elem = e, this.prop = n, this.easing = a || he.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = r || (he.cssNumber[n] ? "" : "px")
        }, cur: function () {
            var e = O.propHooks[this.prop];
            return e && e.get ? e.get(this) : O.propHooks._default.get(this)
        }, run: function (e) {
            var t, n = O.propHooks[this.prop];
            return this.options.duration ? this.pos = t = he.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : O.propHooks._default.set(this), this
        }
    }, O.prototype.init.prototype = O.prototype, O.propHooks = {
        _default: {
            get: function (e) {
                var t;
                return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = he.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0)
            }, set: function (e) {
                he.fx.step[e.prop] ? he.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[he.cssProps[e.prop]] && !he.cssHooks[e.prop] ? e.elem[e.prop] = e.now : he.style(e.elem, e.prop, e.now + e.unit)
            }
        }
    }, O.propHooks.scrollTop = O.propHooks.scrollLeft = {
        set: function (e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, he.easing = {
        linear: function (e) {
            return e
        }, swing: function (e) {
            return .5 - Math.cos(e * Math.PI) / 2
        }, _default: "swing"
    }, he.fx = O.prototype.init, he.fx.step = {};
    var ft, ht, mt = /^(?:toggle|show|hide)$/, gt = /queueHooks$/;
    he.Animation = he.extend(X, {
        tweeners: {
            "*": [function (e, t) {
                var n = this.createTween(e, t);
                return h(n.elem, e, Re.exec(t), n), n
            }]
        }, tweener: function (e, t) {
            he.isFunction(e) ? (t = e, e = ["*"]) : e = e.match(De);
            for (var n, i = 0, a = e.length; i < a; i++)n = e[i], X.tweeners[n] = X.tweeners[n] || [], X.tweeners[n].unshift(t)
        }, prefilters: [_], prefilter: function (e, t) {
            t ? X.prefilters.unshift(e) : X.prefilters.push(e)
        }
    }), he.speed = function (e, t, n) {
        var i = e && "object" == typeof e ? he.extend({}, e) : {
            complete: n || !n && t || he.isFunction(e) && e,
            duration: e,
            easing: n && t || t && !he.isFunction(t) && t
        };
        return he.fx.off || te.hidden ? i.duration = 0 : "number" != typeof i.duration && (i.duration in he.fx.speeds ? i.duration = he.fx.speeds[i.duration] : i.duration = he.fx.speeds._default), null != i.queue && i.queue !== !0 || (i.queue = "fx"), i.old = i.complete, i.complete = function () {
            he.isFunction(i.old) && i.old.call(this), i.queue && he.dequeue(this, i.queue)
        }, i
    }, he.fn.extend({
        fadeTo: function (e, t, n, i) {
            return this.filter(_e).css("opacity", 0).show().end().animate({opacity: t}, e, n, i)
        }, animate: function (e, t, n, i) {
            var a = he.isEmptyObject(e), r = he.speed(t, n, i), o = function () {
                var t = X(this, he.extend({}, e), r);
                (a || je.get(this, "finish")) && t.stop(!0)
            };
            return o.finish = o, a || r.queue === !1 ? this.each(o) : this.queue(r.queue, o)
        }, stop: function (e, t, n) {
            var i = function (e) {
                var t = e.stop;
                delete e.stop, t(n)
            };
            return "string" != typeof e && (n = t, t = e, e = void 0), t && e !== !1 && this.queue(e || "fx", []), this.each(function () {
                var t = !0, a = null != e && e + "queueHooks", r = he.timers, o = je.get(this);
                if (a)o[a] && o[a].stop && i(o[a]); else for (a in o)o[a] && o[a].stop && gt.test(a) && i(o[a]);
                for (a = r.length; a--;)r[a].elem !== this || null != e && r[a].queue !== e || (r[a].anim.stop(n), t = !1, r.splice(a, 1));
                !t && n || he.dequeue(this, e)
            })
        }, finish: function (e) {
            return e !== !1 && (e = e || "fx"), this.each(function () {
                var t, n = je.get(this), i = n[e + "queue"], a = n[e + "queueHooks"], r = he.timers, o = i ? i.length : 0;
                for (n.finish = !0, he.queue(this, e, []), a && a.stop && a.stop.call(this, !0), t = r.length; t--;)r[t].elem === this && r[t].queue === e && (r[t].anim.stop(!0), r.splice(t, 1));
                for (t = 0; t < o; t++)i[t] && i[t].finish && i[t].finish.call(this);
                delete n.finish
            })
        }
    }), he.each(["toggle", "show", "hide"], function (e, t) {
        var n = he.fn[t];
        he.fn[t] = function (e, i, a) {
            return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(R(t, !0), e, i, a)
        }
    }), he.each({
        slideDown: R("show"),
        slideUp: R("hide"),
        slideToggle: R("toggle"),
        fadeIn: {opacity: "show"},
        fadeOut: {opacity: "hide"},
        fadeToggle: {opacity: "toggle"}
    }, function (e, t) {
        he.fn[e] = function (e, n, i) {
            return this.animate(t, e, n, i)
        }
    }), he.timers = [], he.fx.tick = function () {
        var e, t = 0, n = he.timers;
        for (ft = he.now(); t < n.length; t++)e = n[t], e() || n[t] !== e || n.splice(t--, 1);
        n.length || he.fx.stop(), ft = void 0
    }, he.fx.timer = function (e) {
        he.timers.push(e), e() ? he.fx.start() : he.timers.pop()
    }, he.fx.interval = 13, he.fx.start = function () {
        ht || (ht = e.requestAnimationFrame ? e.requestAnimationFrame(q) : e.setInterval(he.fx.tick, he.fx.interval))
    }, he.fx.stop = function () {
        e.cancelAnimationFrame ? e.cancelAnimationFrame(ht) : e.clearInterval(ht), ht = null
    }, he.fx.speeds = {slow: 600, fast: 200, _default: 400}, he.fn.delay = function (t, n) {
        return t = he.fx ? he.fx.speeds[t] || t : t, n = n || "fx", this.queue(n, function (n, i) {
            var a = e.setTimeout(n, t);
            i.stop = function () {
                e.clearTimeout(a)
            }
        })
    }, function () {
        var e = te.createElement("input"), t = te.createElement("select"), n = t.appendChild(te.createElement("option"));
        e.type = "checkbox", ue.checkOn = "" !== e.value, ue.optSelected = n.selected, e = te.createElement("input"), e.value = "t", e.type = "radio", ue.radioValue = "t" === e.value
    }();
    var vt, yt = he.expr.attrHandle;
    he.fn.extend({
        attr: function (e, t) {
            return He(this, he.attr, e, t, arguments.length > 1)
        }, removeAttr: function (e) {
            return this.each(function () {
                he.removeAttr(this, e)
            })
        }
    }), he.extend({
        attr: function (e, t, n) {
            var i, a, r = e.nodeType;
            if (3 !== r && 8 !== r && 2 !== r)return "undefined" == typeof e.getAttribute ? he.prop(e, t, n) : (1 === r && he.isXMLDoc(e) || (a = he.attrHooks[t.toLowerCase()] || (he.expr.match.bool.test(t) ? vt : void 0)), void 0 !== n ? null === n ? void he.removeAttr(e, t) : a && "set" in a && void 0 !== (i = a.set(e, n, t)) ? i : (e.setAttribute(t, n + ""), n) : a && "get" in a && null !== (i = a.get(e, t)) ? i : (i = he.find.attr(e, t), null == i ? void 0 : i))
        }, attrHooks: {
            type: {
                set: function (e, t) {
                    if (!ue.radioValue && "radio" === t && he.nodeName(e, "input")) {
                        var n = e.value;
                        return e.setAttribute("type", t), n && (e.value = n), t
                    }
                }
            }
        }, removeAttr: function (e, t) {
            var n, i = 0, a = t && t.match(De);
            if (a && 1 === e.nodeType)for (; n = a[i++];)e.removeAttribute(n)
        }
    }), vt = {
        set: function (e, t, n) {
            return t === !1 ? he.removeAttr(e, n) : e.setAttribute(n, n), n
        }
    }, he.each(he.expr.match.bool.source.match(/\w+/g), function (e, t) {
        var n = yt[t] || he.find.attr;
        yt[t] = function (e, t, i) {
            var a, r, o = t.toLowerCase();
            return i || (r = yt[o], yt[o] = a, a = null != n(e, t, i) ? o : null, yt[o] = r), a
        }
    });
    var wt = /^(?:input|select|textarea|button)$/i, xt = /^(?:a|area)$/i;
    he.fn.extend({
        prop: function (e, t) {
            return He(this, he.prop, e, t, arguments.length > 1)
        }, removeProp: function (e) {
            return this.each(function () {
                delete this[he.propFix[e] || e]
            })
        }
    }), he.extend({
        prop: function (e, t, n) {
            var i, a, r = e.nodeType;
            if (3 !== r && 8 !== r && 2 !== r)return 1 === r && he.isXMLDoc(e) || (t = he.propFix[t] || t, a = he.propHooks[t]), void 0 !== n ? a && "set" in a && void 0 !== (i = a.set(e, n, t)) ? i : e[t] = n : a && "get" in a && null !== (i = a.get(e, t)) ? i : e[t]
        }, propHooks: {
            tabIndex: {
                get: function (e) {
                    var t = he.find.attr(e, "tabindex");
                    return t ? parseInt(t, 10) : wt.test(e.nodeName) || xt.test(e.nodeName) && e.href ? 0 : -1
                }
            }
        }, propFix: {"for": "htmlFor", "class": "className"}
    }), ue.optSelected || (he.propHooks.selected = {
        get: function (e) {
            var t = e.parentNode;
            return t && t.parentNode && t.parentNode.selectedIndex, null
        }, set: function (e) {
            var t = e.parentNode;
            t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
        }
    }), he.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
        he.propFix[this.toLowerCase()] = this
    }), he.fn.extend({
        addClass: function (e) {
            var t, n, i, a, r, o, s, l = 0;
            if (he.isFunction(e))return this.each(function (t) {
                he(this).addClass(e.call(this, t, G(this)))
            });
            if ("string" == typeof e && e)for (t = e.match(De) || []; n = this[l++];)if (a = G(n), i = 1 === n.nodeType && " " + Y(a) + " ") {
                for (o = 0; r = t[o++];)i.indexOf(" " + r + " ") < 0 && (i += r + " ");
                s = Y(i), a !== s && n.setAttribute("class", s)
            }
            return this
        }, removeClass: function (e) {
            var t, n, i, a, r, o, s, l = 0;
            if (he.isFunction(e))return this.each(function (t) {
                he(this).removeClass(e.call(this, t, G(this)))
            });
            if (!arguments.length)return this.attr("class", "");
            if ("string" == typeof e && e)for (t = e.match(De) || []; n = this[l++];)if (a = G(n), i = 1 === n.nodeType && " " + Y(a) + " ") {
                for (o = 0; r = t[o++];)for (; i.indexOf(" " + r + " ") > -1;)i = i.replace(" " + r + " ", " ");
                s = Y(i), a !== s && n.setAttribute("class", s)
            }
            return this
        }, toggleClass: function (e, t) {
            var n = typeof e;
            return "boolean" == typeof t && "string" === n ? t ? this.addClass(e) : this.removeClass(e) : he.isFunction(e) ? this.each(function (n) {
                he(this).toggleClass(e.call(this, n, G(this), t), t)
            }) : this.each(function () {
                var t, i, a, r;
                if ("string" === n)for (i = 0, a = he(this), r = e.match(De) || []; t = r[i++];)a.hasClass(t) ? a.removeClass(t) : a.addClass(t); else void 0 !== e && "boolean" !== n || (t = G(this), t && je.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || e === !1 ? "" : je.get(this, "__className__") || ""))
            })
        }, hasClass: function (e) {
            var t, n, i = 0;
            for (t = " " + e + " "; n = this[i++];)if (1 === n.nodeType && (" " + Y(G(n)) + " ").indexOf(t) > -1)return !0;
            return !1
        }
    });
    var bt = /\r/g;
    he.fn.extend({
        val: function (e) {
            var t, n, i, a = this[0];
            {
                if (arguments.length)return i = he.isFunction(e), this.each(function (n) {
                    var a;
                    1 === this.nodeType && (a = i ? e.call(this, n, he(this).val()) : e, null == a ? a = "" : "number" == typeof a ? a += "" : he.isArray(a) && (a = he.map(a, function (e) {
                        return null == e ? "" : e + ""
                    })), t = he.valHooks[this.type] || he.valHooks[this.nodeName.toLowerCase()], t && "set" in t && void 0 !== t.set(this, a, "value") || (this.value = a))
                });
                if (a)return t = he.valHooks[a.type] || he.valHooks[a.nodeName.toLowerCase()], t && "get" in t && void 0 !== (n = t.get(a, "value")) ? n : (n = a.value, "string" == typeof n ? n.replace(bt, "") : null == n ? "" : n)
            }
        }
    }), he.extend({
        valHooks: {
            option: {
                get: function (e) {
                    var t = he.find.attr(e, "value");
                    return null != t ? t : Y(he.text(e))
                }
            }, select: {
                get: function (e) {
                    var t, n, i, a = e.options, r = e.selectedIndex, o = "select-one" === e.type, s = o ? null : [], l = o ? r + 1 : a.length;
                    for (i = r < 0 ? l : o ? r : 0; i < l; i++)if (n = a[i], (n.selected || i === r) && !n.disabled && (!n.parentNode.disabled || !he.nodeName(n.parentNode, "optgroup"))) {
                        if (t = he(n).val(), o)return t;
                        s.push(t)
                    }
                    return s
                }, set: function (e, t) {
                    for (var n, i, a = e.options, r = he.makeArray(t), o = a.length; o--;)i = a[o], (i.selected = he.inArray(he.valHooks.option.get(i), r) > -1) && (n = !0);
                    return n || (e.selectedIndex = -1), r
                }
            }
        }
    }), he.each(["radio", "checkbox"], function () {
        he.valHooks[this] = {
            set: function (e, t) {
                if (he.isArray(t))return e.checked = he.inArray(he(e).val(), t) > -1
            }
        }, ue.checkOn || (he.valHooks[this].get = function (e) {
            return null === e.getAttribute("value") ? "on" : e.value
        })
    });
    var Ct = /^(?:focusinfocus|focusoutblur)$/;
    he.extend(he.event, {
        trigger: function (t, n, i, a) {
            var r, o, s, l, d, c, p, u = [i || te], f = de.call(t, "type") ? t.type : t, h = de.call(t, "namespace") ? t.namespace.split(".") : [];
            if (o = s = i = i || te, 3 !== i.nodeType && 8 !== i.nodeType && !Ct.test(f + he.event.triggered) && (f.indexOf(".") > -1 && (h = f.split("."), f = h.shift(), h.sort()), d = f.indexOf(":") < 0 && "on" + f, t = t[he.expando] ? t : new he.Event(f, "object" == typeof t && t), t.isTrigger = a ? 2 : 3, t.namespace = h.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = i), n = null == n ? [t] : he.makeArray(n, [t]), p = he.event.special[f] || {}, a || !p.trigger || p.trigger.apply(i, n) !== !1)) {
                if (!a && !p.noBubble && !he.isWindow(i)) {
                    for (l = p.delegateType || f, Ct.test(l + f) || (o = o.parentNode); o; o = o.parentNode)u.push(o), s = o;
                    s === (i.ownerDocument || te) && u.push(s.defaultView || s.parentWindow || e)
                }
                for (r = 0; (o = u[r++]) && !t.isPropagationStopped();)t.type = r > 1 ? l : p.bindType || f, c = (je.get(o, "events") || {})[t.type] && je.get(o, "handle"), c && c.apply(o, n), c = d && o[d], c && c.apply && Ie(o) && (t.result = c.apply(o, n), t.result === !1 && t.preventDefault());
                return t.type = f, a || t.isDefaultPrevented() || p._default && p._default.apply(u.pop(), n) !== !1 || !Ie(i) || d && he.isFunction(i[f]) && !he.isWindow(i) && (s = i[d], s && (i[d] = null), he.event.triggered = f, i[f](), he.event.triggered = void 0, s && (i[d] = s)), t.result
            }
        }, simulate: function (e, t, n) {
            var i = he.extend(new he.Event, n, {type: e, isSimulated: !0});
            he.event.trigger(i, null, t)
        }
    }), he.fn.extend({
        trigger: function (e, t) {
            return this.each(function () {
                he.event.trigger(e, t, this)
            })
        }, triggerHandler: function (e, t) {
            var n = this[0];
            if (n)return he.event.trigger(e, t, n, !0)
        }
    }), he.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (e, t) {
        he.fn[t] = function (e, n) {
            return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
        }
    }), he.fn.extend({
        hover: function (e, t) {
            return this.mouseenter(e).mouseleave(t || e)
        }
    }), ue.focusin = "onfocusin" in e, ue.focusin || he.each({focus: "focusin", blur: "focusout"}, function (e, t) {
        var n = function (e) {
            he.event.simulate(t, e.target, he.event.fix(e))
        };
        he.event.special[t] = {
            setup: function () {
                var i = this.ownerDocument || this, a = je.access(i, t);
                a || i.addEventListener(e, n, !0), je.access(i, t, (a || 0) + 1)
            }, teardown: function () {
                var i = this.ownerDocument || this, a = je.access(i, t) - 1;
                a ? je.access(i, t, a) : (i.removeEventListener(e, n, !0), je.remove(i, t))
            }
        }
    });
    var Tt = e.location, St = he.now(), kt = /\?/;
    he.parseXML = function (t) {
        var n;
        if (!t || "string" != typeof t)return null;
        try {
            n = (new e.DOMParser).parseFromString(t, "text/xml")
        } catch (i) {
            n = void 0
        }
        return n && !n.getElementsByTagName("parsererror").length || he.error("Invalid XML: " + t), n
    };
    var Et = /\[\]$/, Mt = /\r?\n/g, zt = /^(?:submit|button|image|reset|file)$/i, Pt = /^(?:input|select|textarea|keygen)/i;
    he.param = function (e, t) {
        var n, i = [], a = function (e, t) {
            var n = he.isFunction(t) ? t() : t;
            i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n)
        };
        if (he.isArray(e) || e.jquery && !he.isPlainObject(e))he.each(e, function () {
            a(this.name, this.value)
        }); else for (n in e)V(n, e[n], t, a);
        return i.join("&")
    }, he.fn.extend({
        serialize: function () {
            return he.param(this.serializeArray())
        }, serializeArray: function () {
            return this.map(function () {
                var e = he.prop(this, "elements");
                return e ? he.makeArray(e) : this
            }).filter(function () {
                var e = this.type;
                return this.name && !he(this).is(":disabled") && Pt.test(this.nodeName) && !zt.test(e) && (this.checked || !Ye.test(e))
            }).map(function (e, t) {
                var n = he(this).val();
                return null == n ? null : he.isArray(n) ? he.map(n, function (e) {
                    return {name: t.name, value: e.replace(Mt, "\r\n")}
                }) : {name: t.name, value: n.replace(Mt, "\r\n")}
            }).get()
        }
    });
    var Dt = /%20/g, Lt = /#.*$/, At = /([?&])_=[^&]*/, Ht = /^(.*?):[ \t]*([^\r\n]*)$/gm, It = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, jt = /^(?:GET|HEAD)$/, Nt = /^\/\//, Ot = {}, qt = {}, Wt = "*/".concat("*"), Rt = te.createElement("a");
    Rt.href = Tt.href, he.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Tt.href,
            type: "GET",
            isLocal: It.test(Tt.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Wt,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/},
            responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
            converters: {"* text": String, "text html": !0, "text json": JSON.parse, "text xml": he.parseXML},
            flatOptions: {url: !0, context: !0}
        },
        ajaxSetup: function (e, t) {
            return t ? U(U(e, he.ajaxSettings), t) : U(he.ajaxSettings, e)
        },
        ajaxPrefilter: $(Ot),
        ajaxTransport: $(qt),
        ajax: function (t, n) {
            function i(t, n, i, s) {
                var d, u, f, x, b, C = n;
                c || (c = !0, l && e.clearTimeout(l), a = void 0, o = s || "", T.readyState = t > 0 ? 4 : 0, d = t >= 200 && t < 300 || 304 === t, i && (x = Z(h, T, i)), x = Q(h, x, T, d), d ? (h.ifModified && (b = T.getResponseHeader("Last-Modified"), b && (he.lastModified[r] = b), b = T.getResponseHeader("etag"), b && (he.etag[r] = b)), 204 === t || "HEAD" === h.type ? C = "nocontent" : 304 === t ? C = "notmodified" : (C = x.state, u = x.data, f = x.error, d = !f)) : (f = C, !t && C || (C = "error", t < 0 && (t = 0))), T.status = t, T.statusText = (n || C) + "", d ? v.resolveWith(m, [u, C, T]) : v.rejectWith(m, [T, C, f]), T.statusCode(w), w = void 0, p && g.trigger(d ? "ajaxSuccess" : "ajaxError", [T, h, d ? u : f]), y.fireWith(m, [T, C]), p && (g.trigger("ajaxComplete", [T, h]), --he.active || he.event.trigger("ajaxStop")))
            }

            "object" == typeof t && (n = t, t = void 0), n = n || {};
            var a, r, o, s, l, d, c, p, u, f, h = he.ajaxSetup({}, n), m = h.context || h, g = h.context && (m.nodeType || m.jquery) ? he(m) : he.event, v = he.Deferred(), y = he.Callbacks("once memory"), w = h.statusCode || {}, x = {}, b = {}, C = "canceled", T = {
                readyState: 0,
                getResponseHeader: function (e) {
                    var t;
                    if (c) {
                        if (!s)for (s = {}; t = Ht.exec(o);)s[t[1].toLowerCase()] = t[2];
                        t = s[e.toLowerCase()]
                    }
                    return null == t ? null : t
                },
                getAllResponseHeaders: function () {
                    return c ? o : null
                },
                setRequestHeader: function (e, t) {
                    return null == c && (e = b[e.toLowerCase()] = b[e.toLowerCase()] || e, x[e] = t), this
                },
                overrideMimeType: function (e) {
                    return null == c && (h.mimeType = e), this
                },
                statusCode: function (e) {
                    var t;
                    if (e)if (c)T.always(e[T.status]); else for (t in e)w[t] = [w[t], e[t]];
                    return this
                },
                abort: function (e) {
                    var t = e || C;
                    return a && a.abort(t), i(0, t), this
                }
            };
            if (v.promise(T), h.url = ((t || h.url || Tt.href) + "").replace(Nt, Tt.protocol + "//"), h.type = n.method || n.type || h.method || h.type, h.dataTypes = (h.dataType || "*").toLowerCase().match(De) || [""], null == h.crossDomain) {
                d = te.createElement("a");
                try {
                    d.href = h.url, d.href = d.href, h.crossDomain = Rt.protocol + "//" + Rt.host != d.protocol + "//" + d.host
                } catch (S) {
                    h.crossDomain = !0
                }
            }
            if (h.data && h.processData && "string" != typeof h.data && (h.data = he.param(h.data, h.traditional)), K(Ot, h, n, T), c)return T;
            p = he.event && h.global, p && 0 === he.active++ && he.event.trigger("ajaxStart"), h.type = h.type.toUpperCase(), h.hasContent = !jt.test(h.type), r = h.url.replace(Lt, ""), h.hasContent ? h.data && h.processData && 0 === (h.contentType || "").indexOf("application/x-www-form-urlencoded") && (h.data = h.data.replace(Dt, "+")) : (f = h.url.slice(r.length), h.data && (r += (kt.test(r) ? "&" : "?") + h.data, delete h.data), h.cache === !1 && (r = r.replace(At, "$1"), f = (kt.test(r) ? "&" : "?") + "_=" + St++ + f), h.url = r + f), h.ifModified && (he.lastModified[r] && T.setRequestHeader("If-Modified-Since", he.lastModified[r]), he.etag[r] && T.setRequestHeader("If-None-Match", he.etag[r])), (h.data && h.hasContent && h.contentType !== !1 || n.contentType) && T.setRequestHeader("Content-Type", h.contentType), T.setRequestHeader("Accept", h.dataTypes[0] && h.accepts[h.dataTypes[0]] ? h.accepts[h.dataTypes[0]] + ("*" !== h.dataTypes[0] ? ", " + Wt + "; q=0.01" : "") : h.accepts["*"]);
            for (u in h.headers)T.setRequestHeader(u, h.headers[u]);
            if (h.beforeSend && (h.beforeSend.call(m, T, h) === !1 || c))return T.abort();
            if (C = "abort", y.add(h.complete), T.done(h.success), T.fail(h.error), a = K(qt, h, n, T)) {
                if (T.readyState = 1, p && g.trigger("ajaxSend", [T, h]), c)return T;
                h.async && h.timeout > 0 && (l = e.setTimeout(function () {
                    T.abort("timeout")
                }, h.timeout));
                try {
                    c = !1, a.send(x, i)
                } catch (S) {
                    if (c)throw S;
                    i(-1, S)
                }
            } else i(-1, "No Transport");
            return T
        },
        getJSON: function (e, t, n) {
            return he.get(e, t, n, "json")
        },
        getScript: function (e, t) {
            return he.get(e, void 0, t, "script")
        }
    }), he.each(["get", "post"], function (e, t) {
        he[t] = function (e, n, i, a) {
            return he.isFunction(n) && (a = a || i, i = n, n = void 0), he.ajax(he.extend({
                url: e,
                type: t,
                dataType: a,
                data: n,
                success: i
            }, he.isPlainObject(e) && e))
        }
    }), he._evalUrl = function (e) {
        return he.ajax({url: e, type: "GET", dataType: "script", cache: !0, async: !1, global: !1, "throws": !0})
    }, he.fn.extend({
        wrapAll: function (e) {
            var t;
            return this[0] && (he.isFunction(e) && (e = e.call(this[0])), t = he(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                for (var e = this; e.firstElementChild;)e = e.firstElementChild;
                return e
            }).append(this)), this
        }, wrapInner: function (e) {
            return he.isFunction(e) ? this.each(function (t) {
                he(this).wrapInner(e.call(this, t))
            }) : this.each(function () {
                var t = he(this), n = t.contents();
                n.length ? n.wrapAll(e) : t.append(e)
            })
        }, wrap: function (e) {
            var t = he.isFunction(e);
            return this.each(function (n) {
                he(this).wrapAll(t ? e.call(this, n) : e)
            })
        }, unwrap: function (e) {
            return this.parent(e).not("body").each(function () {
                he(this).replaceWith(this.childNodes)
            }), this
        }
    }), he.expr.pseudos.hidden = function (e) {
        return !he.expr.pseudos.visible(e)
    }, he.expr.pseudos.visible = function (e) {
        return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length)
    }, he.ajaxSettings.xhr = function () {
        try {
            return new e.XMLHttpRequest
        } catch (t) {
        }
    };
    var Bt = {0: 200, 1223: 204}, _t = he.ajaxSettings.xhr();
    ue.cors = !!_t && "withCredentials" in _t, ue.ajax = _t = !!_t, he.ajaxTransport(function (t) {
        var n, i;
        if (ue.cors || _t && !t.crossDomain)return {
            send: function (a, r) {
                var o, s = t.xhr();
                if (s.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields)for (o in t.xhrFields)s[o] = t.xhrFields[o];
                t.mimeType && s.overrideMimeType && s.overrideMimeType(t.mimeType), t.crossDomain || a["X-Requested-With"] || (a["X-Requested-With"] = "XMLHttpRequest");
                for (o in a)s.setRequestHeader(o, a[o]);
                n = function (e) {
                    return function () {
                        n && (n = i = s.onload = s.onerror = s.onabort = s.onreadystatechange = null, "abort" === e ? s.abort() : "error" === e ? "number" != typeof s.status ? r(0, "error") : r(s.status, s.statusText) : r(Bt[s.status] || s.status, s.statusText, "text" !== (s.responseType || "text") || "string" != typeof s.responseText ? {binary: s.response} : {text: s.responseText}, s.getAllResponseHeaders()))
                    }
                }, s.onload = n(), i = s.onerror = n("error"), void 0 !== s.onabort ? s.onabort = i : s.onreadystatechange = function () {
                    4 === s.readyState && e.setTimeout(function () {
                        n && i()
                    })
                }, n = n("abort");
                try {
                    s.send(t.hasContent && t.data || null)
                } catch (l) {
                    if (n)throw l
                }
            }, abort: function () {
                n && n()
            }
        }
    }), he.ajaxPrefilter(function (e) {
        e.crossDomain && (e.contents.script = !1)
    }), he.ajaxSetup({
        accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
        contents: {script: /\b(?:java|ecma)script\b/},
        converters: {
            "text script": function (e) {
                return he.globalEval(e), e
            }
        }
    }), he.ajaxPrefilter("script", function (e) {
        void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
    }), he.ajaxTransport("script", function (e) {
        if (e.crossDomain) {
            var t, n;
            return {
                send: function (i, a) {
                    t = he("<script>").prop({charset: e.scriptCharset, src: e.url}).on("load error", n = function (e) {
                        t.remove(), n = null, e && a("error" === e.type ? 404 : 200, e.type)
                    }), te.head.appendChild(t[0])
                }, abort: function () {
                    n && n()
                }
            }
        }
    });
    var Ft = [], Xt = /(=)\?(?=&|$)|\?\?/;
    he.ajaxSetup({
        jsonp: "callback", jsonpCallback: function () {
            var e = Ft.pop() || he.expando + "_" + St++;
            return this[e] = !0, e
        }
    }), he.ajaxPrefilter("json jsonp", function (t, n, i) {
        var a, r, o, s = t.jsonp !== !1 && (Xt.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && Xt.test(t.data) && "data");
        if (s || "jsonp" === t.dataTypes[0])return a = t.jsonpCallback = he.isFunction(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, s ? t[s] = t[s].replace(Xt, "$1" + a) : t.jsonp !== !1 && (t.url += (kt.test(t.url) ? "&" : "?") + t.jsonp + "=" + a), t.converters["script json"] = function () {
            return o || he.error(a + " was not called"), o[0]
        }, t.dataTypes[0] = "json", r = e[a], e[a] = function () {
            o = arguments
        }, i.always(function () {
            void 0 === r ? he(e).removeProp(a) : e[a] = r, t[a] && (t.jsonpCallback = n.jsonpCallback, Ft.push(a)), o && he.isFunction(r) && r(o[0]), o = r = void 0
        }), "script"
    }), ue.createHTMLDocument = function () {
        var e = te.implementation.createHTMLDocument("").body;
        return e.innerHTML = "<form></form><form></form>", 2 === e.childNodes.length
    }(), he.parseHTML = function (e, t, n) {
        if ("string" != typeof e)return [];
        "boolean" == typeof t && (n = t, t = !1);
        var i, a, r;
        return t || (ue.createHTMLDocument ? (t = te.implementation.createHTMLDocument(""), i = t.createElement("base"), i.href = te.location.href, t.head.appendChild(i)) : t = te), a = Te.exec(e), r = !n && [], a ? [t.createElement(a[1])] : (a = w([e], t, r), r && r.length && he(r).remove(), he.merge([], a.childNodes))
    }, he.fn.load = function (e, t, n) {
        var i, a, r, o = this, s = e.indexOf(" ");
        return s > -1 && (i = Y(e.slice(s)), e = e.slice(0, s)), he.isFunction(t) ? (n = t, t = void 0) : t && "object" == typeof t && (a = "POST"), o.length > 0 && he.ajax({
            url: e,
            type: a || "GET",
            dataType: "html",
            data: t
        }).done(function (e) {
            r = arguments, o.html(i ? he("<div>").append(he.parseHTML(e)).find(i) : e)
        }).always(n && function (e, t) {
                o.each(function () {
                    n.apply(this, r || [e.responseText, t, e])
                })
            }), this
    }, he.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
        he.fn[t] = function (e) {
            return this.on(t, e)
        }
    }), he.expr.pseudos.animated = function (e) {
        return he.grep(he.timers, function (t) {
            return e === t.elem
        }).length
    }, he.offset = {
        setOffset: function (e, t, n) {
            var i, a, r, o, s, l, d, c = he.css(e, "position"), p = he(e), u = {};
            "static" === c && (e.style.position = "relative"), s = p.offset(), r = he.css(e, "top"), l = he.css(e, "left"), d = ("absolute" === c || "fixed" === c) && (r + l).indexOf("auto") > -1, d ? (i = p.position(), o = i.top, a = i.left) : (o = parseFloat(r) || 0, a = parseFloat(l) || 0), he.isFunction(t) && (t = t.call(e, n, he.extend({}, s))), null != t.top && (u.top = t.top - s.top + o), null != t.left && (u.left = t.left - s.left + a), "using" in t ? t.using.call(e, u) : p.css(u)
        }
    }, he.fn.extend({
        offset: function (e) {
            if (arguments.length)return void 0 === e ? this : this.each(function (t) {
                he.offset.setOffset(this, e, t)
            });
            var t, n, i, a, r = this[0];
            if (r)return r.getClientRects().length ? (i = r.getBoundingClientRect(), i.width || i.height ? (a = r.ownerDocument, n = J(a), t = a.documentElement, {
                top: i.top + n.pageYOffset - t.clientTop,
                left: i.left + n.pageXOffset - t.clientLeft
            }) : i) : {top: 0, left: 0}
        }, position: function () {
            if (this[0]) {
                var e, t, n = this[0], i = {top: 0, left: 0};
                return "fixed" === he.css(n, "position") ? t = n.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), he.nodeName(e[0], "html") || (i = e.offset()), i = {
                    top: i.top + he.css(e[0], "borderTopWidth", !0),
                    left: i.left + he.css(e[0], "borderLeftWidth", !0)
                }), {
                    top: t.top - i.top - he.css(n, "marginTop", !0),
                    left: t.left - i.left - he.css(n, "marginLeft", !0)
                }
            }
        }, offsetParent: function () {
            return this.map(function () {
                for (var e = this.offsetParent; e && "static" === he.css(e, "position");)e = e.offsetParent;
                return e || Ue
            })
        }
    }), he.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (e, t) {
        var n = "pageYOffset" === t;
        he.fn[e] = function (i) {
            return He(this, function (e, i, a) {
                var r = J(e);
                return void 0 === a ? r ? r[t] : e[i] : void(r ? r.scrollTo(n ? r.pageXOffset : a, n ? a : r.pageYOffset) : e[i] = a)
            }, e, i, arguments.length)
        }
    }), he.each(["top", "left"], function (e, t) {
        he.cssHooks[t] = A(ue.pixelPosition, function (e, n) {
            if (n)return n = L(e, t), ot.test(n) ? he(e).position()[t] + "px" : n
        })
    }), he.each({Height: "height", Width: "width"}, function (e, t) {
        he.each({padding: "inner" + e, content: t, "": "outer" + e}, function (n, i) {
            he.fn[i] = function (a, r) {
                var o = arguments.length && (n || "boolean" != typeof a), s = n || (a === !0 || r === !0 ? "margin" : "border");
                return He(this, function (t, n, a) {
                    var r;
                    return he.isWindow(t) ? 0 === i.indexOf("outer") ? t["inner" + e] : t.document.documentElement["client" + e] : 9 === t.nodeType ? (r = t.documentElement, Math.max(t.body["scroll" + e], r["scroll" + e], t.body["offset" + e], r["offset" + e], r["client" + e])) : void 0 === a ? he.css(t, n, s) : he.style(t, n, a, s)
                }, t, o ? a : void 0, o)
            }
        })
    }), he.fn.extend({
        bind: function (e, t, n) {
            return this.on(e, null, t, n)
        }, unbind: function (e, t) {
            return this.off(e, null, t)
        }, delegate: function (e, t, n, i) {
            return this.on(t, e, n, i)
        }, undelegate: function (e, t, n) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
        }
    }), he.parseJSON = JSON.parse, "function" == typeof define && define.amd && define("jquery", [], function () {
        return he
    });
    var Yt = e.jQuery, Gt = e.$;
    return he.noConflict = function (t) {
        return e.$ === he && (e.$ = Gt), t && e.jQuery === he && (e.jQuery = Yt), he
    }, t || (e.jQuery = e.$ = he), he
}), function () {
    "use strict";
    function e(e) {
        e.fn.swiper = function (t) {
            var i;
            return e(this).each(function () {
                var e = new n(this, t);
                i || (i = e)
            }), i
        }
    }

    var t, n = function (e, a) {
        function o(e) {
            return Math.floor(e)
        }

        function s() {
            var e = T.params.autoplay, t = T.slides.eq(T.activeIndex);
            t.attr("data-swiper-autoplay") && (e = t.attr("data-swiper-autoplay") || T.params.autoplay), T.autoplayTimeoutId = setTimeout(function () {
                T.params.loop ? (T.fixLoop(), T._slideNext(), T.emit("onAutoplay", T)) : T.isEnd ? a.autoplayStopOnLast ? T.stopAutoplay() : (T._slideTo(0), T.emit("onAutoplay", T)) : (T._slideNext(), T.emit("onAutoplay", T))
            }, e)
        }

        function l(e, n) {
            var i = t(e.target);
            if (!i.is(n))if ("string" == typeof n)i = i.parents(n); else if (n.nodeType) {
                var a;
                return i.parents().each(function (e, t) {
                    t === n && (a = n)
                }), a ? n : void 0
            }
            if (0 !== i.length)return i[0]
        }

        function d(e, t) {
            t = t || {};
            var n = window.MutationObserver || window.WebkitMutationObserver, i = new n(function (e) {
                e.forEach(function (e) {
                    T.onResize(!0), T.emit("onObserverUpdate", T, e)
                })
            });
            i.observe(e, {
                attributes: "undefined" == typeof t.attributes || t.attributes,
                childList: "undefined" == typeof t.childList || t.childList,
                characterData: "undefined" == typeof t.characterData || t.characterData
            }), T.observers.push(i)
        }

        function c(e) {
            e.originalEvent && (e = e.originalEvent);
            var t = e.keyCode || e.charCode;
            if (!T.params.allowSwipeToNext && (T.isHorizontal() && 39 === t || !T.isHorizontal() && 40 === t))return !1;
            if (!T.params.allowSwipeToPrev && (T.isHorizontal() && 37 === t || !T.isHorizontal() && 38 === t))return !1;
            if (!(e.shiftKey || e.altKey || e.ctrlKey || e.metaKey || document.activeElement && document.activeElement.nodeName && ("input" === document.activeElement.nodeName.toLowerCase() || "textarea" === document.activeElement.nodeName.toLowerCase()))) {
                if (37 === t || 39 === t || 38 === t || 40 === t) {
                    var n = !1;
                    if (T.container.parents("." + T.params.slideClass).length > 0 && 0 === T.container.parents("." + T.params.slideActiveClass).length)return;
                    var i = {
                        left: window.pageXOffset,
                        top: window.pageYOffset
                    }, a = window.innerWidth, r = window.innerHeight, o = T.container.offset();
                    T.rtl && (o.left = o.left - T.container[0].scrollLeft);
                    for (var s = [[o.left, o.top], [o.left + T.width, o.top], [o.left, o.top + T.height], [o.left + T.width, o.top + T.height]], l = 0; l < s.length; l++) {
                        var d = s[l];
                        d[0] >= i.left && d[0] <= i.left + a && d[1] >= i.top && d[1] <= i.top + r && (n = !0)
                    }
                    if (!n)return
                }
                T.isHorizontal() ? (37 !== t && 39 !== t || (e.preventDefault ? e.preventDefault() : e.returnValue = !1), (39 === t && !T.rtl || 37 === t && T.rtl) && T.slideNext(), (37 === t && !T.rtl || 39 === t && T.rtl) && T.slidePrev()) : (38 !== t && 40 !== t || (e.preventDefault ? e.preventDefault() : e.returnValue = !1), 40 === t && T.slideNext(), 38 === t && T.slidePrev())
            }
        }

        function p() {
            var e = "onwheel", t = e in document;
            if (!t) {
                var n = document.createElement("div");
                n.setAttribute(e, "return;"), t = "function" == typeof n[e]
            }
            return !t && document.implementation && document.implementation.hasFeature && document.implementation.hasFeature("", "") !== !0 && (t = document.implementation.hasFeature("Events.wheel", "3.0")), t
        }

        function u(e) {
            e.originalEvent && (e = e.originalEvent);
            var t = 0, n = T.rtl ? -1 : 1, i = f(e);
            if (T.params.mousewheelForceToAxis)if (T.isHorizontal()) {
                if (!(Math.abs(i.pixelX) > Math.abs(i.pixelY)))return;
                t = i.pixelX * n
            } else {
                if (!(Math.abs(i.pixelY) > Math.abs(i.pixelX)))return;
                t = i.pixelY
            } else t = Math.abs(i.pixelX) > Math.abs(i.pixelY) ? -i.pixelX * n : -i.pixelY;
            if (0 !== t) {
                if (T.params.mousewheelInvert && (t = -t), T.params.freeMode) {
                    var a = T.getWrapperTranslate() + t * T.params.mousewheelSensitivity, r = T.isBeginning, o = T.isEnd;
                    if (a >= T.minTranslate() && (a = T.minTranslate()), a <= T.maxTranslate() && (a = T.maxTranslate()), T.setWrapperTransition(0), T.setWrapperTranslate(a), T.updateProgress(), T.updateActiveIndex(), (!r && T.isBeginning || !o && T.isEnd) && T.updateClasses(), T.params.freeModeSticky ? (clearTimeout(T.mousewheel.timeout), T.mousewheel.timeout = setTimeout(function () {
                            T.slideReset()
                        }, 300)) : T.params.lazyLoading && T.lazy && T.lazy.load(), T.emit("onScroll", T, e), T.params.autoplay && T.params.autoplayDisableOnInteraction && T.stopAutoplay(), 0 === a || a === T.maxTranslate())return
                } else {
                    if ((new window.Date).getTime() - T.mousewheel.lastScrollTime > 60)if (t < 0)if (T.isEnd && !T.params.loop || T.animating) {
                        if (T.params.mousewheelReleaseOnEdges)return !0
                    } else T.slideNext(), T.emit("onScroll", T, e); else if (T.isBeginning && !T.params.loop || T.animating) {
                        if (T.params.mousewheelReleaseOnEdges)return !0
                    } else T.slidePrev(), T.emit("onScroll", T, e);
                    T.mousewheel.lastScrollTime = (new window.Date).getTime()
                }
                return e.preventDefault ? e.preventDefault() : e.returnValue = !1, !1
            }
        }

        function f(e) {
            var t = 10, n = 40, i = 800, a = 0, r = 0, o = 0, s = 0;
            return "detail" in e && (r = e.detail), "wheelDelta" in e && (r = -e.wheelDelta / 120), "wheelDeltaY" in e && (r = -e.wheelDeltaY / 120), "wheelDeltaX" in e && (a = -e.wheelDeltaX / 120), "axis" in e && e.axis === e.HORIZONTAL_AXIS && (a = r, r = 0), o = a * t, s = r * t, "deltaY" in e && (s = e.deltaY), "deltaX" in e && (o = e.deltaX), (o || s) && e.deltaMode && (1 === e.deltaMode ? (o *= n, s *= n) : (o *= i, s *= i)), o && !a && (a = o < 1 ? -1 : 1), s && !r && (r = s < 1 ? -1 : 1), {
                spinX: a,
                spinY: r,
                pixelX: o,
                pixelY: s
            }
        }

        function h(e, n) {
            e = t(e);
            var i, a, r, o = T.rtl ? -1 : 1;
            i = e.attr("data-swiper-parallax") || "0", a = e.attr("data-swiper-parallax-x"), r = e.attr("data-swiper-parallax-y"), a || r ? (a = a || "0", r = r || "0") : T.isHorizontal() ? (a = i, r = "0") : (r = i, a = "0"), a = a.indexOf("%") >= 0 ? parseInt(a, 10) * n * o + "%" : a * n * o + "px", r = r.indexOf("%") >= 0 ? parseInt(r, 10) * n + "%" : r * n + "px", e.transform("translate3d(" + a + ", " + r + ",0px)")
        }

        function m(e) {
            return 0 !== e.indexOf("on") && (e = e[0] !== e[0].toUpperCase() ? "on" + e[0].toUpperCase() + e.substring(1) : "on" + e), e
        }

        if (!(this instanceof n))return new n(e, a);
        var g = {
            direction: "horizontal",
            touchEventsTarget: "container",
            initialSlide: 0,
            speed: 300,
            autoplay: !1,
            autoplayDisableOnInteraction: !0,
            autoplayStopOnLast: !1,
            iOSEdgeSwipeDetection: !1,
            iOSEdgeSwipeThreshold: 20,
            freeMode: !1,
            freeModeMomentum: !0,
            freeModeMomentumRatio: 1,
            freeModeMomentumBounce: !0,
            freeModeMomentumBounceRatio: 1,
            freeModeMomentumVelocityRatio: 1,
            freeModeSticky: !1,
            freeModeMinimumVelocity: .02,
            autoHeight: !1,
            setWrapperSize: !1,
            virtualTranslate: !1,
            effect: "slide",
            coverflow: {rotate: 50, stretch: 0, depth: 100, modifier: 1, slideShadows: !0},
            flip: {slideShadows: !0, limitRotation: !0},
            cube: {slideShadows: !0, shadow: !0, shadowOffset: 20, shadowScale: .94},
            fade: {crossFade: !1},
            parallax: !1,
            zoom: !1,
            zoomMax: 3,
            zoomMin: 1,
            zoomToggle: !0,
            scrollbar: null,
            scrollbarHide: !0,
            scrollbarDraggable: !1,
            scrollbarSnapOnRelease: !1,
            keyboardControl: !1,
            mousewheelControl: !1,
            mousewheelReleaseOnEdges: !1,
            mousewheelInvert: !1,
            mousewheelForceToAxis: !1,
            mousewheelSensitivity: 1,
            mousewheelEventsTarged: "container",
            hashnav: !1,
            hashnavWatchState: !1,
            history: !1,
            replaceState: !1,
            breakpoints: void 0,
            spaceBetween: 0,
            slidesPerView: 1,
            slidesPerColumn: 1,
            slidesPerColumnFill: "column",
            slidesPerGroup: 1,
            centeredSlides: !1,
            slidesOffsetBefore: 0,
            slidesOffsetAfter: 0,
            roundLengths: !1,
            touchRatio: 1,
            touchAngle: 45,
            simulateTouch: !0,
            shortSwipes: !0,
            longSwipes: !0,
            longSwipesRatio: .5,
            longSwipesMs: 300,
            followFinger: !0,
            onlyExternal: !1,
            threshold: 0,
            touchMoveStopPropagation: !0,
            touchReleaseOnEdges: !1,
            uniqueNavElements: !0,
            pagination: null,
            paginationElement: "span",
            paginationClickable: !1,
            paginationHide: !1,
            paginationBulletRender: null,
            paginationProgressRender: null,
            paginationFractionRender: null,
            paginationCustomRender: null,
            paginationType: "bullets",
            resistance: !0,
            resistanceRatio: .85,
            nextButton: null,
            prevButton: null,
            watchSlidesProgress: !1,
            watchSlidesVisibility: !1,
            grabCursor: !1,
            preventClicks: !0,
            preventClicksPropagation: !0,
            slideToClickedSlide: !1,
            lazyLoading: !1,
            lazyLoadingInPrevNext: !1,
            lazyLoadingInPrevNextAmount: 1,
            lazyLoadingOnTransitionStart: !1,
            preloadImages: !0,
            updateOnImagesReady: !0,
            loop: !1,
            loopAdditionalSlides: 0,
            loopedSlides: null,
            control: void 0,
            controlInverse: !1,
            controlBy: "slide",
            normalizeSlideIndex: !0,
            allowSwipeToPrev: !0,
            allowSwipeToNext: !0,
            swipeHandler: null,
            noSwiping: !0,
            noSwipingClass: "swiper-no-swiping",
            passiveListeners: !0,
            containerModifierClass: "swiper-container-",
            slideClass: "swiper-slide",
            slideActiveClass: "swiper-slide-active",
            slideDuplicateActiveClass: "swiper-slide-duplicate-active",
            slideVisibleClass: "swiper-slide-visible",
            slideDuplicateClass: "swiper-slide-duplicate",
            slideNextClass: "swiper-slide-next",
            slideDuplicateNextClass: "swiper-slide-duplicate-next",
            slidePrevClass: "swiper-slide-prev",
            slideDuplicatePrevClass: "swiper-slide-duplicate-prev",
            wrapperClass: "swiper-wrapper",
            bulletClass: "swiper-pagination-bullet",
            bulletActiveClass: "swiper-pagination-bullet-active",
            buttonDisabledClass: "swiper-button-disabled",
            paginationCurrentClass: "swiper-pagination-current",
            paginationTotalClass: "swiper-pagination-total",
            paginationHiddenClass: "swiper-pagination-hidden",
            paginationProgressbarClass: "swiper-pagination-progressbar",
            paginationClickableClass: "swiper-pagination-clickable",
            paginationModifierClass: "swiper-pagination-",
            lazyLoadingClass: "swiper-lazy",
            lazyStatusLoadingClass: "swiper-lazy-loading",
            lazyStatusLoadedClass: "swiper-lazy-loaded",
            lazyPreloaderClass: "swiper-lazy-preloader",
            notificationClass: "swiper-notification",
            preloaderClass: "preloader",
            zoomContainerClass: "swiper-zoom-container",
            observer: !1,
            observeParents: !1,
            a11y: !1,
            prevSlideMessage: "Previous slide",
            nextSlideMessage: "Next slide",
            firstSlideMessage: "This is the first slide",
            lastSlideMessage: "This is the last slide",
            paginationBulletMessage: "Go to slide {{index}}",
            runCallbacksOnInit: !0
        }, v = a && a.virtualTranslate;
        a = a || {};
        var y = {};
        for (var w in a)if ("object" != typeof a[w] || null === a[w] || (a[w].nodeType || a[w] === window || a[w] === document || "undefined" != typeof i && a[w] instanceof i || "undefined" != typeof jQuery && a[w] instanceof jQuery))y[w] = a[w]; else {
            y[w] = {};
            for (var x in a[w])y[w][x] = a[w][x]
        }
        for (var b in g)if ("undefined" == typeof a[b])a[b] = g[b]; else if ("object" == typeof a[b])for (var C in g[b])"undefined" == typeof a[b][C] && (a[b][C] = g[b][C]);
        var T = this;
        if (T.params = a, T.originalParams = y, T.classNames = [], "undefined" != typeof t && "undefined" != typeof i && (t = i), ("undefined" != typeof t || (t = "undefined" == typeof i ? window.Dom7 || window.Zepto || window.jQuery : i)) && (T.$ = t, T.currentBreakpoint = void 0, T.getActiveBreakpoint = function () {
                if (!T.params.breakpoints)return !1;
                var e, t = !1, n = [];
                for (e in T.params.breakpoints)T.params.breakpoints.hasOwnProperty(e) && n.push(e);
                n.sort(function (e, t) {
                    return parseInt(e, 10) > parseInt(t, 10)
                });
                for (var i = 0; i < n.length; i++)e = n[i], e >= window.innerWidth && !t && (t = e);
                return t || "max"
            }, T.setBreakpoint = function () {
                var e = T.getActiveBreakpoint();
                if (e && T.currentBreakpoint !== e) {
                    var t = e in T.params.breakpoints ? T.params.breakpoints[e] : T.originalParams, n = T.params.loop && t.slidesPerView !== T.params.slidesPerView;
                    for (var i in t)T.params[i] = t[i];
                    T.currentBreakpoint = e, n && T.destroyLoop && T.reLoop(!0)
                }
            }, T.params.breakpoints && T.setBreakpoint(), T.container = t(e), 0 !== T.container.length)) {
            if (T.container.length > 1) {
                var S = [];
                return T.container.each(function () {
                    S.push(new n(this, a))
                }), S
            }
            T.container[0].swiper = T, T.container.data("swiper", T), T.classNames.push(T.params.containerModifierClass + T.params.direction), T.params.freeMode && T.classNames.push(T.params.containerModifierClass + "free-mode"), T.support.flexbox || (T.classNames.push(T.params.containerModifierClass + "no-flexbox"), T.params.slidesPerColumn = 1), T.params.autoHeight && T.classNames.push(T.params.containerModifierClass + "autoheight"), (T.params.parallax || T.params.watchSlidesVisibility) && (T.params.watchSlidesProgress = !0), T.params.touchReleaseOnEdges && (T.params.resistanceRatio = 0), ["cube", "coverflow", "flip"].indexOf(T.params.effect) >= 0 && (T.support.transforms3d ? (T.params.watchSlidesProgress = !0, T.classNames.push(T.params.containerModifierClass + "3d")) : T.params.effect = "slide"), "slide" !== T.params.effect && T.classNames.push(T.params.containerModifierClass + T.params.effect), "cube" === T.params.effect && (T.params.resistanceRatio = 0, T.params.slidesPerView = 1, T.params.slidesPerColumn = 1, T.params.slidesPerGroup = 1, T.params.centeredSlides = !1, T.params.spaceBetween = 0, T.params.virtualTranslate = !0, T.params.setWrapperSize = !1), "fade" !== T.params.effect && "flip" !== T.params.effect || (T.params.slidesPerView = 1, T.params.slidesPerColumn = 1, T.params.slidesPerGroup = 1, T.params.watchSlidesProgress = !0, T.params.spaceBetween = 0, T.params.setWrapperSize = !1, "undefined" == typeof v && (T.params.virtualTranslate = !0)), T.params.grabCursor && T.support.touch && (T.params.grabCursor = !1), T.wrapper = T.container.children("." + T.params.wrapperClass), T.params.pagination && (T.paginationContainer = t(T.params.pagination), T.params.uniqueNavElements && "string" == typeof T.params.pagination && T.paginationContainer.length > 1 && 1 === T.container.find(T.params.pagination).length && (T.paginationContainer = T.container.find(T.params.pagination)), "bullets" === T.params.paginationType && T.params.paginationClickable ? T.paginationContainer.addClass(T.params.paginationModifierClass + "clickable") : T.params.paginationClickable = !1, T.paginationContainer.addClass(T.params.paginationModifierClass + T.params.paginationType)), (T.params.nextButton || T.params.prevButton) && (T.params.nextButton && (T.nextButton = t(T.params.nextButton), T.params.uniqueNavElements && "string" == typeof T.params.nextButton && T.nextButton.length > 1 && 1 === T.container.find(T.params.nextButton).length && (T.nextButton = T.container.find(T.params.nextButton))), T.params.prevButton && (T.prevButton = t(T.params.prevButton), T.params.uniqueNavElements && "string" == typeof T.params.prevButton && T.prevButton.length > 1 && 1 === T.container.find(T.params.prevButton).length && (T.prevButton = T.container.find(T.params.prevButton)))), T.isHorizontal = function () {
                return "horizontal" === T.params.direction
            }, T.rtl = T.isHorizontal() && ("rtl" === T.container[0].dir.toLowerCase() || "rtl" === T.container.css("direction")), T.rtl && T.classNames.push(T.params.containerModifierClass + "rtl"), T.rtl && (T.wrongRTL = "-webkit-box" === T.wrapper.css("display")), T.params.slidesPerColumn > 1 && T.classNames.push(T.params.containerModifierClass + "multirow"), T.device.android && T.classNames.push(T.params.containerModifierClass + "android"), T.container.addClass(T.classNames.join(" ")), T.translate = 0, T.progress = 0, T.velocity = 0, T.lockSwipeToNext = function () {
                T.params.allowSwipeToNext = !1, T.params.allowSwipeToPrev === !1 && T.params.grabCursor && T.unsetGrabCursor()
            }, T.lockSwipeToPrev = function () {
                T.params.allowSwipeToPrev = !1, T.params.allowSwipeToNext === !1 && T.params.grabCursor && T.unsetGrabCursor()
            }, T.lockSwipes = function () {
                T.params.allowSwipeToNext = T.params.allowSwipeToPrev = !1, T.params.grabCursor && T.unsetGrabCursor()
            }, T.unlockSwipeToNext = function () {
                T.params.allowSwipeToNext = !0, T.params.allowSwipeToPrev === !0 && T.params.grabCursor && T.setGrabCursor()
            }, T.unlockSwipeToPrev = function () {
                T.params.allowSwipeToPrev = !0, T.params.allowSwipeToNext === !0 && T.params.grabCursor && T.setGrabCursor()
            }, T.unlockSwipes = function () {
                T.params.allowSwipeToNext = T.params.allowSwipeToPrev = !0, T.params.grabCursor && T.setGrabCursor()
            }, T.setGrabCursor = function (e) {
                T.container[0].style.cursor = "move", T.container[0].style.cursor = e ? "-webkit-grabbing" : "-webkit-grab", T.container[0].style.cursor = e ? "-moz-grabbin" : "-moz-grab", T.container[0].style.cursor = e ? "grabbing" : "grab"
            }, T.unsetGrabCursor = function () {
                T.container[0].style.cursor = ""
            }, T.params.grabCursor && T.setGrabCursor(), T.imagesToLoad = [], T.imagesLoaded = 0, T.loadImage = function (e, t, n, i, a, r) {
                function o() {
                    r && r()
                }

                var s;
                e.complete && a ? o() : t ? (s = new window.Image, s.onload = o, s.onerror = o, i && (s.sizes = i), n && (s.srcset = n), t && (s.src = t)) : o()
            }, T.preloadImages = function () {
                function e() {
                    "undefined" != typeof T && null !== T && (void 0 !== T.imagesLoaded && T.imagesLoaded++, T.imagesLoaded === T.imagesToLoad.length && (T.params.updateOnImagesReady && T.update(), T.emit("onImagesReady", T)))
                }

                T.imagesToLoad = T.container.find("img");
                for (var t = 0; t < T.imagesToLoad.length; t++)T.loadImage(T.imagesToLoad[t], T.imagesToLoad[t].currentSrc || T.imagesToLoad[t].getAttribute("src"), T.imagesToLoad[t].srcset || T.imagesToLoad[t].getAttribute("srcset"), T.imagesToLoad[t].sizes || T.imagesToLoad[t].getAttribute("sizes"), !0, e)
            }, T.autoplayTimeoutId = void 0, T.autoplaying = !1, T.autoplayPaused = !1, T.startAutoplay = function () {
                return "undefined" == typeof T.autoplayTimeoutId && (!!T.params.autoplay && (!T.autoplaying && (T.autoplaying = !0, T.emit("onAutoplayStart", T), void s())))
            }, T.stopAutoplay = function (e) {
                T.autoplayTimeoutId && (T.autoplayTimeoutId && clearTimeout(T.autoplayTimeoutId), T.autoplaying = !1, T.autoplayTimeoutId = void 0, T.emit("onAutoplayStop", T))
            }, T.pauseAutoplay = function (e) {
                T.autoplayPaused || (T.autoplayTimeoutId && clearTimeout(T.autoplayTimeoutId), T.autoplayPaused = !0, 0 === e ? (T.autoplayPaused = !1, s()) : T.wrapper.transitionEnd(function () {
                    T && (T.autoplayPaused = !1, T.autoplaying ? s() : T.stopAutoplay())
                }))
            }, T.minTranslate = function () {
                return -T.snapGrid[0]
            }, T.maxTranslate = function () {
                return -T.snapGrid[T.snapGrid.length - 1]
            }, T.updateAutoHeight = function () {
                var e = [], t = 0;
                if ("auto" !== T.params.slidesPerView && T.params.slidesPerView > 1)for (r = 0; r < Math.ceil(T.params.slidesPerView); r++) {
                    var n = T.activeIndex + r;
                    if (n > T.slides.length)break;
                    e.push(T.slides.eq(n)[0])
                } else e.push(T.slides.eq(T.activeIndex)[0]);
                for (r = 0; r < e.length; r++)if ("undefined" != typeof e[r]) {
                    var i = e[r].offsetHeight;
                    t = i > t ? i : t
                }
                t && T.wrapper.css("height", t + "px")
            }, T.updateContainerSize = function () {
                var e, t;
                e = "undefined" != typeof T.params.width ? T.params.width : T.container[0].clientWidth, t = "undefined" != typeof T.params.height ? T.params.height : T.container[0].clientHeight, 0 === e && T.isHorizontal() || 0 === t && !T.isHorizontal() || (e = e - parseInt(T.container.css("padding-left"), 10) - parseInt(T.container.css("padding-right"), 10), t = t - parseInt(T.container.css("padding-top"), 10) - parseInt(T.container.css("padding-bottom"), 10), T.width = e, T.height = t, T.size = T.isHorizontal() ? T.width : T.height)
            }, T.updateSlidesSize = function () {
                T.slides = T.wrapper.children("." + T.params.slideClass), T.snapGrid = [], T.slidesGrid = [], T.slidesSizesGrid = [];
                var e, t = T.params.spaceBetween, n = -T.params.slidesOffsetBefore, i = 0, a = 0;
                if ("undefined" != typeof T.size) {
                    "string" == typeof t && t.indexOf("%") >= 0 && (t = parseFloat(t.replace("%", "")) / 100 * T.size), T.virtualSize = -t, T.rtl ? T.slides.css({
                        marginLeft: "",
                        marginTop: ""
                    }) : T.slides.css({marginRight: "", marginBottom: ""});
                    var r;
                    T.params.slidesPerColumn > 1 && (r = Math.floor(T.slides.length / T.params.slidesPerColumn) === T.slides.length / T.params.slidesPerColumn ? T.slides.length : Math.ceil(T.slides.length / T.params.slidesPerColumn) * T.params.slidesPerColumn, "auto" !== T.params.slidesPerView && "row" === T.params.slidesPerColumnFill && (r = Math.max(r, T.params.slidesPerView * T.params.slidesPerColumn)));
                    var s, l = T.params.slidesPerColumn, d = r / l, c = d - (T.params.slidesPerColumn * d - T.slides.length);
                    for (e = 0; e < T.slides.length; e++) {
                        s = 0;
                        var p = T.slides.eq(e);
                        if (T.params.slidesPerColumn > 1) {
                            var u, f, h;
                            "column" === T.params.slidesPerColumnFill ? (f = Math.floor(e / l), h = e - f * l, (f > c || f === c && h === l - 1) && ++h >= l && (h = 0, f++), u = f + h * r / l, p.css({
                                "-webkit-box-ordinal-group": u,
                                "-moz-box-ordinal-group": u,
                                "-ms-flex-order": u,
                                "-webkit-order": u,
                                order: u
                            })) : (h = Math.floor(e / d), f = e - h * d), p.css("margin-" + (T.isHorizontal() ? "top" : "left"), 0 !== h && T.params.spaceBetween && T.params.spaceBetween + "px").attr("data-swiper-column", f).attr("data-swiper-row", h)
                        }
                        "none" !== p.css("display") && ("auto" === T.params.slidesPerView ? (s = T.isHorizontal() ? p.outerWidth(!0) : p.outerHeight(!0), T.params.roundLengths && (s = o(s))) : (s = (T.size - (T.params.slidesPerView - 1) * t) / T.params.slidesPerView, T.params.roundLengths && (s = o(s)), T.isHorizontal() ? T.slides[e].style.width = s + "px" : T.slides[e].style.height = s + "px"), T.slides[e].swiperSlideSize = s, T.slidesSizesGrid.push(s), T.params.centeredSlides ? (n = n + s / 2 + i / 2 + t, 0 === e && (n = n - T.size / 2 - t), Math.abs(n) < .001 && (n = 0), a % T.params.slidesPerGroup === 0 && T.snapGrid.push(n), T.slidesGrid.push(n)) : (a % T.params.slidesPerGroup === 0 && T.snapGrid.push(n), T.slidesGrid.push(n), n = n + s + t), T.virtualSize += s + t, i = s, a++)
                    }
                    T.virtualSize = Math.max(T.virtualSize, T.size) + T.params.slidesOffsetAfter;
                    var m;
                    if (T.rtl && T.wrongRTL && ("slide" === T.params.effect || "coverflow" === T.params.effect) && T.wrapper.css({width: T.virtualSize + T.params.spaceBetween + "px"}), T.support.flexbox && !T.params.setWrapperSize || (T.isHorizontal() ? T.wrapper.css({width: T.virtualSize + T.params.spaceBetween + "px"}) : T.wrapper.css({height: T.virtualSize + T.params.spaceBetween + "px"})), T.params.slidesPerColumn > 1 && (T.virtualSize = (s + T.params.spaceBetween) * r, T.virtualSize = Math.ceil(T.virtualSize / T.params.slidesPerColumn) - T.params.spaceBetween, T.isHorizontal() ? T.wrapper.css({width: T.virtualSize + T.params.spaceBetween + "px"}) : T.wrapper.css({height: T.virtualSize + T.params.spaceBetween + "px"}), T.params.centeredSlides)) {
                        for (m = [], e = 0; e < T.snapGrid.length; e++)T.snapGrid[e] < T.virtualSize + T.snapGrid[0] && m.push(T.snapGrid[e]);
                        T.snapGrid = m
                    }
                    if (!T.params.centeredSlides) {
                        for (m = [], e = 0; e < T.snapGrid.length; e++)T.snapGrid[e] <= T.virtualSize - T.size && m.push(T.snapGrid[e]);
                        T.snapGrid = m, Math.floor(T.virtualSize - T.size) - Math.floor(T.snapGrid[T.snapGrid.length - 1]) > 1 && T.snapGrid.push(T.virtualSize - T.size)
                    }
                    0 === T.snapGrid.length && (T.snapGrid = [0]), 0 !== T.params.spaceBetween && (T.isHorizontal() ? T.rtl ? T.slides.css({marginLeft: t + "px"}) : T.slides.css({marginRight: t + "px"}) : T.slides.css({marginBottom: t + "px"})), T.params.watchSlidesProgress && T.updateSlidesOffset()
                }
            }, T.updateSlidesOffset = function () {
                for (var e = 0; e < T.slides.length; e++)T.slides[e].swiperSlideOffset = T.isHorizontal() ? T.slides[e].offsetLeft : T.slides[e].offsetTop
            }, T.updateSlidesProgress = function (e) {
                if ("undefined" == typeof e && (e = T.translate || 0), 0 !== T.slides.length) {
                    "undefined" == typeof T.slides[0].swiperSlideOffset && T.updateSlidesOffset();
                    var t = -e;
                    T.rtl && (t = e), T.slides.removeClass(T.params.slideVisibleClass);
                    for (var n = 0; n < T.slides.length; n++) {
                        var i = T.slides[n], a = (t + (T.params.centeredSlides ? T.minTranslate() : 0) - i.swiperSlideOffset) / (i.swiperSlideSize + T.params.spaceBetween);
                        if (T.params.watchSlidesVisibility) {
                            var r = -(t - i.swiperSlideOffset), o = r + T.slidesSizesGrid[n], s = r >= 0 && r < T.size || o > 0 && o <= T.size || r <= 0 && o >= T.size;
                            s && T.slides.eq(n).addClass(T.params.slideVisibleClass)
                        }
                        i.progress = T.rtl ? -a : a
                    }
                }
            }, T.updateProgress = function (e) {
                "undefined" == typeof e && (e = T.translate || 0);
                var t = T.maxTranslate() - T.minTranslate(), n = T.isBeginning, i = T.isEnd;
                0 === t ? (T.progress = 0, T.isBeginning = T.isEnd = !0) : (T.progress = (e - T.minTranslate()) / t, T.isBeginning = T.progress <= 0, T.isEnd = T.progress >= 1), T.isBeginning && !n && T.emit("onReachBeginning", T), T.isEnd && !i && T.emit("onReachEnd", T), T.params.watchSlidesProgress && T.updateSlidesProgress(e), T.emit("onProgress", T, T.progress)
            }, T.updateActiveIndex = function () {
                var e, t, n, i = T.rtl ? T.translate : -T.translate;
                for (t = 0; t < T.slidesGrid.length; t++)"undefined" != typeof T.slidesGrid[t + 1] ? i >= T.slidesGrid[t] && i < T.slidesGrid[t + 1] - (T.slidesGrid[t + 1] - T.slidesGrid[t]) / 2 ? e = t : i >= T.slidesGrid[t] && i < T.slidesGrid[t + 1] && (e = t + 1) : i >= T.slidesGrid[t] && (e = t);
                T.params.normalizeSlideIndex && (e < 0 || "undefined" == typeof e) && (e = 0), n = Math.floor(e / T.params.slidesPerGroup), n >= T.snapGrid.length && (n = T.snapGrid.length - 1), e !== T.activeIndex && (T.snapIndex = n, T.previousIndex = T.activeIndex, T.activeIndex = e, T.updateClasses(), T.updateRealIndex())
            }, T.updateRealIndex = function () {
                T.realIndex = T.slides.eq(T.activeIndex).attr("data-swiper-slide-index") || T.activeIndex
            }, T.updateClasses = function () {
                T.slides.removeClass(T.params.slideActiveClass + " " + T.params.slideNextClass + " " + T.params.slidePrevClass + " " + T.params.slideDuplicateActiveClass + " " + T.params.slideDuplicateNextClass + " " + T.params.slideDuplicatePrevClass);
                var e = T.slides.eq(T.activeIndex);
                e.addClass(T.params.slideActiveClass), a.loop && (e.hasClass(T.params.slideDuplicateClass) ? T.wrapper.children("." + T.params.slideClass + ":not(." + T.params.slideDuplicateClass + ')[data-swiper-slide-index="' + T.realIndex + '"]').addClass(T.params.slideDuplicateActiveClass) : T.wrapper.children("." + T.params.slideClass + "." + T.params.slideDuplicateClass + '[data-swiper-slide-index="' + T.realIndex + '"]').addClass(T.params.slideDuplicateActiveClass));
                var n = e.next("." + T.params.slideClass).addClass(T.params.slideNextClass);
                T.params.loop && 0 === n.length && (n = T.slides.eq(0), n.addClass(T.params.slideNextClass));
                var i = e.prev("." + T.params.slideClass).addClass(T.params.slidePrevClass);
                if (T.params.loop && 0 === i.length && (i = T.slides.eq(-1), i.addClass(T.params.slidePrevClass)), a.loop && (n.hasClass(T.params.slideDuplicateClass) ? T.wrapper.children("." + T.params.slideClass + ":not(." + T.params.slideDuplicateClass + ')[data-swiper-slide-index="' + n.attr("data-swiper-slide-index") + '"]').addClass(T.params.slideDuplicateNextClass) : T.wrapper.children("." + T.params.slideClass + "." + T.params.slideDuplicateClass + '[data-swiper-slide-index="' + n.attr("data-swiper-slide-index") + '"]').addClass(T.params.slideDuplicateNextClass), i.hasClass(T.params.slideDuplicateClass) ? T.wrapper.children("." + T.params.slideClass + ":not(." + T.params.slideDuplicateClass + ')[data-swiper-slide-index="' + i.attr("data-swiper-slide-index") + '"]').addClass(T.params.slideDuplicatePrevClass) : T.wrapper.children("." + T.params.slideClass + "." + T.params.slideDuplicateClass + '[data-swiper-slide-index="' + i.attr("data-swiper-slide-index") + '"]').addClass(T.params.slideDuplicatePrevClass)), T.paginationContainer && T.paginationContainer.length > 0) {
                    var r, o = T.params.loop ? Math.ceil((T.slides.length - 2 * T.loopedSlides) / T.params.slidesPerGroup) : T.snapGrid.length;
                    if (T.params.loop ? (r = Math.ceil((T.activeIndex - T.loopedSlides) / T.params.slidesPerGroup), r > T.slides.length - 1 - 2 * T.loopedSlides && (r -= T.slides.length - 2 * T.loopedSlides), r > o - 1 && (r -= o), r < 0 && "bullets" !== T.params.paginationType && (r = o + r)) : r = "undefined" != typeof T.snapIndex ? T.snapIndex : T.activeIndex || 0, "bullets" === T.params.paginationType && T.bullets && T.bullets.length > 0 && (T.bullets.removeClass(T.params.bulletActiveClass), T.paginationContainer.length > 1 ? T.bullets.each(function () {
                            t(this).index() === r && t(this).addClass(T.params.bulletActiveClass)
                        }) : T.bullets.eq(r).addClass(T.params.bulletActiveClass)), "fraction" === T.params.paginationType && (T.paginationContainer.find("." + T.params.paginationCurrentClass).text(r + 1), T.paginationContainer.find("." + T.params.paginationTotalClass).text(o)), "progress" === T.params.paginationType) {
                        var s = (r + 1) / o, l = s, d = 1;
                        T.isHorizontal() || (d = s, l = 1), T.paginationContainer.find("." + T.params.paginationProgressbarClass).transform("translate3d(0,0,0) scaleX(" + l + ") scaleY(" + d + ")").transition(T.params.speed)
                    }
                    "custom" === T.params.paginationType && T.params.paginationCustomRender && (T.paginationContainer.html(T.params.paginationCustomRender(T, r + 1, o)), T.emit("onPaginationRendered", T, T.paginationContainer[0]))
                }
                T.params.loop || (T.params.prevButton && T.prevButton && T.prevButton.length > 0 && (T.isBeginning ? (T.prevButton.addClass(T.params.buttonDisabledClass), T.params.a11y && T.a11y && T.a11y.disable(T.prevButton)) : (T.prevButton.removeClass(T.params.buttonDisabledClass), T.params.a11y && T.a11y && T.a11y.enable(T.prevButton))), T.params.nextButton && T.nextButton && T.nextButton.length > 0 && (T.isEnd ? (T.nextButton.addClass(T.params.buttonDisabledClass), T.params.a11y && T.a11y && T.a11y.disable(T.nextButton)) : (T.nextButton.removeClass(T.params.buttonDisabledClass), T.params.a11y && T.a11y && T.a11y.enable(T.nextButton))))
            }, T.updatePagination = function () {
                if (T.params.pagination && T.paginationContainer && T.paginationContainer.length > 0) {
                    var e = "";
                    if ("bullets" === T.params.paginationType) {
                        for (var t = T.params.loop ? Math.ceil((T.slides.length - 2 * T.loopedSlides) / T.params.slidesPerGroup) : T.snapGrid.length, n = 0; n < t; n++)e += T.params.paginationBulletRender ? T.params.paginationBulletRender(T, n, T.params.bulletClass) : "<" + T.params.paginationElement + ' class="' + T.params.bulletClass + '"></' + T.params.paginationElement + ">";
                        T.paginationContainer.html(e), T.bullets = T.paginationContainer.find("." + T.params.bulletClass), T.params.paginationClickable && T.params.a11y && T.a11y && T.a11y.initPagination()
                    }
                    "fraction" === T.params.paginationType && (e = T.params.paginationFractionRender ? T.params.paginationFractionRender(T, T.params.paginationCurrentClass, T.params.paginationTotalClass) : '<span class="' + T.params.paginationCurrentClass + '"></span> / <span class="' + T.params.paginationTotalClass + '"></span>', T.paginationContainer.html(e)), "progress" === T.params.paginationType && (e = T.params.paginationProgressRender ? T.params.paginationProgressRender(T, T.params.paginationProgressbarClass) : '<span class="' + T.params.paginationProgressbarClass + '"></span>', T.paginationContainer.html(e)), "custom" !== T.params.paginationType && T.emit("onPaginationRendered", T, T.paginationContainer[0])
                }
            }, T.update = function (e) {
                function t() {
                    T.rtl ? -T.translate : T.translate;
                    i = Math.min(Math.max(T.translate, T.maxTranslate()), T.minTranslate()), T.setWrapperTranslate(i), T.updateActiveIndex(), T.updateClasses()
                }

                if (T.updateContainerSize(), T.updateSlidesSize(), T.updateProgress(), T.updatePagination(), T.updateClasses(), T.params.scrollbar && T.scrollbar && T.scrollbar.set(), e) {
                    var n, i;
                    T.controller && T.controller.spline && (T.controller.spline = void 0), T.params.freeMode ? (t(), T.params.autoHeight && T.updateAutoHeight()) : (n = ("auto" === T.params.slidesPerView || T.params.slidesPerView > 1) && T.isEnd && !T.params.centeredSlides ? T.slideTo(T.slides.length - 1, 0, !1, !0) : T.slideTo(T.activeIndex, 0, !1, !0), n || t())
                } else T.params.autoHeight && T.updateAutoHeight()
            }, T.onResize = function (e) {
                T.params.breakpoints && T.setBreakpoint();
                var t = T.params.allowSwipeToPrev, n = T.params.allowSwipeToNext;
                T.params.allowSwipeToPrev = T.params.allowSwipeToNext = !0, T.updateContainerSize(), T.updateSlidesSize(), ("auto" === T.params.slidesPerView || T.params.freeMode || e) && T.updatePagination(), T.params.scrollbar && T.scrollbar && T.scrollbar.set(), T.controller && T.controller.spline && (T.controller.spline = void 0);
                var i = !1;
                if (T.params.freeMode) {
                    var a = Math.min(Math.max(T.translate, T.maxTranslate()), T.minTranslate());
                    T.setWrapperTranslate(a), T.updateActiveIndex(), T.updateClasses(), T.params.autoHeight && T.updateAutoHeight()
                } else T.updateClasses(), i = ("auto" === T.params.slidesPerView || T.params.slidesPerView > 1) && T.isEnd && !T.params.centeredSlides ? T.slideTo(T.slides.length - 1, 0, !1, !0) : T.slideTo(T.activeIndex, 0, !1, !0);
                T.params.lazyLoading && !i && T.lazy && T.lazy.load(), T.params.allowSwipeToPrev = t, T.params.allowSwipeToNext = n
            }, T.touchEventsDesktop = {
                start: "mousedown",
                move: "mousemove",
                end: "mouseup"
            }, window.navigator.pointerEnabled ? T.touchEventsDesktop = {
                start: "pointerdown",
                move: "pointermove",
                end: "pointerup"
            } : window.navigator.msPointerEnabled && (T.touchEventsDesktop = {
                start: "MSPointerDown",
                move: "MSPointerMove",
                end: "MSPointerUp"
            }), T.touchEvents = {
                start: T.support.touch || !T.params.simulateTouch ? "touchstart" : T.touchEventsDesktop.start,
                move: T.support.touch || !T.params.simulateTouch ? "touchmove" : T.touchEventsDesktop.move,
                end: T.support.touch || !T.params.simulateTouch ? "touchend" : T.touchEventsDesktop.end
            }, (window.navigator.pointerEnabled || window.navigator.msPointerEnabled) && ("container" === T.params.touchEventsTarget ? T.container : T.wrapper).addClass("swiper-wp8-" + T.params.direction), T.initEvents = function (e) {
                var t = e ? "off" : "on", n = e ? "removeEventListener" : "addEventListener", i = "container" === T.params.touchEventsTarget ? T.container[0] : T.wrapper[0], r = T.support.touch ? i : document, o = !!T.params.nested;
                if (T.browser.ie)i[n](T.touchEvents.start, T.onTouchStart, !1), r[n](T.touchEvents.move, T.onTouchMove, o), r[n](T.touchEvents.end, T.onTouchEnd, !1); else {
                    if (T.support.touch) {
                        var s = !("touchstart" !== T.touchEvents.start || !T.support.passiveListener || !T.params.passiveListeners) && {
                                passive: !0,
                                capture: !1
                            };
                        i[n](T.touchEvents.start, T.onTouchStart, s), i[n](T.touchEvents.move, T.onTouchMove, o), i[n](T.touchEvents.end, T.onTouchEnd, s)
                    }
                    (a.simulateTouch && !T.device.ios && !T.device.android || a.simulateTouch && !T.support.touch && T.device.ios) && (i[n]("mousedown", T.onTouchStart, !1), document[n]("mousemove", T.onTouchMove, o), document[n]("mouseup", T.onTouchEnd, !1))
                }
                window[n]("resize", T.onResize), T.params.nextButton && T.nextButton && T.nextButton.length > 0 && (T.nextButton[t]("click", T.onClickNext), T.params.a11y && T.a11y && T.nextButton[t]("keydown", T.a11y.onEnterKey)), T.params.prevButton && T.prevButton && T.prevButton.length > 0 && (T.prevButton[t]("click", T.onClickPrev), T.params.a11y && T.a11y && T.prevButton[t]("keydown", T.a11y.onEnterKey)), T.params.pagination && T.params.paginationClickable && (T.paginationContainer[t]("click", "." + T.params.bulletClass, T.onClickIndex), T.params.a11y && T.a11y && T.paginationContainer[t]("keydown", "." + T.params.bulletClass, T.a11y.onEnterKey)), (T.params.preventClicks || T.params.preventClicksPropagation) && i[n]("click", T.preventClicks, !0)
            }, T.attachEvents = function () {
                T.initEvents()
            }, T.detachEvents = function () {
                T.initEvents(!0)
            }, T.allowClick = !0, T.preventClicks = function (e) {
                T.allowClick || (T.params.preventClicks && e.preventDefault(), T.params.preventClicksPropagation && T.animating && (e.stopPropagation(), e.stopImmediatePropagation()))
            }, T.onClickNext = function (e) {
                e.preventDefault(), T.isEnd && !T.params.loop || T.slideNext()
            }, T.onClickPrev = function (e) {
                e.preventDefault(), T.isBeginning && !T.params.loop || T.slidePrev()
            }, T.onClickIndex = function (e) {
                e.preventDefault();
                var n = t(this).index() * T.params.slidesPerGroup;
                T.params.loop && (n += T.loopedSlides), T.slideTo(n)
            }, T.updateClickedSlide = function (e) {
                var n = l(e, "." + T.params.slideClass), i = !1;
                if (n)for (var a = 0; a < T.slides.length; a++)T.slides[a] === n && (i = !0);
                if (!n || !i)return T.clickedSlide = void 0, void(T.clickedIndex = void 0);
                if (T.clickedSlide = n, T.clickedIndex = t(n).index(), T.params.slideToClickedSlide && void 0 !== T.clickedIndex && T.clickedIndex !== T.activeIndex) {
                    var r, o = T.clickedIndex;
                    if (T.params.loop) {
                        if (T.animating)return;
                        r = t(T.clickedSlide).attr("data-swiper-slide-index"), T.params.centeredSlides ? o < T.loopedSlides - T.params.slidesPerView / 2 || o > T.slides.length - T.loopedSlides + T.params.slidesPerView / 2 ? (T.fixLoop(), o = T.wrapper.children("." + T.params.slideClass + '[data-swiper-slide-index="' + r + '"]:not(.' + T.params.slideDuplicateClass + ")").eq(0).index(), setTimeout(function () {
                            T.slideTo(o)
                        }, 0)) : T.slideTo(o) : o > T.slides.length - T.params.slidesPerView ? (T.fixLoop(), o = T.wrapper.children("." + T.params.slideClass + '[data-swiper-slide-index="' + r + '"]:not(.' + T.params.slideDuplicateClass + ")").eq(0).index(), setTimeout(function () {
                            T.slideTo(o)
                        }, 0)) : T.slideTo(o)
                    } else T.slideTo(o)
                }
            };
            var k, E, M, z, P, D, L, A, H, I, j = "input, select, textarea, button, video", N = Date.now(), O = [];
            T.animating = !1, T.touches = {startX: 0, startY: 0, currentX: 0, currentY: 0, diff: 0};
            var q, W;
            T.onTouchStart = function (e) {
                if (e.originalEvent && (e = e.originalEvent), q = "touchstart" === e.type, q || !("which" in e) || 3 !== e.which) {
                    if (T.params.noSwiping && l(e, "." + T.params.noSwipingClass))return void(T.allowClick = !0);
                    if (!T.params.swipeHandler || l(e, T.params.swipeHandler)) {
                        var n = T.touches.currentX = "touchstart" === e.type ? e.targetTouches[0].pageX : e.pageX, i = T.touches.currentY = "touchstart" === e.type ? e.targetTouches[0].pageY : e.pageY;
                        if (!(T.device.ios && T.params.iOSEdgeSwipeDetection && n <= T.params.iOSEdgeSwipeThreshold)) {
                            if (k = !0, E = !1, M = !0, P = void 0, W = void 0, T.touches.startX = n, T.touches.startY = i, z = Date.now(), T.allowClick = !0, T.updateContainerSize(), T.swipeDirection = void 0, T.params.threshold > 0 && (A = !1), "touchstart" !== e.type) {
                                var a = !0;
                                t(e.target).is(j) && (a = !1), document.activeElement && t(document.activeElement).is(j) && document.activeElement.blur(), a && e.preventDefault()
                            }
                            T.emit("onTouchStart", T, e)
                        }
                    }
                }
            }, T.onTouchMove = function (e) {
                if (e.originalEvent && (e = e.originalEvent), !q || "mousemove" !== e.type) {
                    if (e.preventedByNestedSwiper)return T.touches.startX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, void(T.touches.startY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY);
                    if (T.params.onlyExternal)return T.allowClick = !1, void(k && (T.touches.startX = T.touches.currentX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, T.touches.startY = T.touches.currentY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, z = Date.now()));
                    if (q && T.params.touchReleaseOnEdges && !T.params.loop)if (T.isHorizontal()) {
                        if (T.touches.currentX < T.touches.startX && T.translate <= T.maxTranslate() || T.touches.currentX > T.touches.startX && T.translate >= T.minTranslate())return
                    } else if (T.touches.currentY < T.touches.startY && T.translate <= T.maxTranslate() || T.touches.currentY > T.touches.startY && T.translate >= T.minTranslate())return;
                    if (q && document.activeElement && e.target === document.activeElement && t(e.target).is(j))return E = !0, void(T.allowClick = !1);
                    if (M && T.emit("onTouchMove", T, e), !(e.targetTouches && e.targetTouches.length > 1)) {
                        if (T.touches.currentX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, T.touches.currentY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, "undefined" == typeof P) {
                            var n;
                            T.isHorizontal() && T.touches.currentY === T.touches.startY || !T.isHorizontal() && T.touches.currentX !== T.touches.startX ? P = !1 : (n = 180 * Math.atan2(Math.abs(T.touches.currentY - T.touches.startY), Math.abs(T.touches.currentX - T.touches.startX)) / Math.PI, P = T.isHorizontal() ? n > T.params.touchAngle : 90 - n > T.params.touchAngle)
                        }
                        if (P && T.emit("onTouchMoveOpposite", T, e), "undefined" == typeof W && T.browser.ieTouch && (T.touches.currentX === T.touches.startX && T.touches.currentY === T.touches.startY || (W = !0)), k) {
                            if (P)return void(k = !1);
                            if (W || !T.browser.ieTouch) {
                                T.allowClick = !1, T.emit("onSliderMove", T, e), e.preventDefault(), T.params.touchMoveStopPropagation && !T.params.nested && e.stopPropagation(), E || (a.loop && T.fixLoop(), L = T.getWrapperTranslate(), T.setWrapperTransition(0), T.animating && T.wrapper.trigger("webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd msTransitionEnd"), T.params.autoplay && T.autoplaying && (T.params.autoplayDisableOnInteraction ? T.stopAutoplay() : T.pauseAutoplay()), I = !1, !T.params.grabCursor || T.params.allowSwipeToNext !== !0 && T.params.allowSwipeToPrev !== !0 || T.setGrabCursor(!0)), E = !0;
                                var i = T.touches.diff = T.isHorizontal() ? T.touches.currentX - T.touches.startX : T.touches.currentY - T.touches.startY;
                                i *= T.params.touchRatio, T.rtl && (i = -i), T.swipeDirection = i > 0 ? "prev" : "next", D = i + L;
                                var r = !0;
                                if (i > 0 && D > T.minTranslate() ? (r = !1, T.params.resistance && (D = T.minTranslate() - 1 + Math.pow(-T.minTranslate() + L + i, T.params.resistanceRatio))) : i < 0 && D < T.maxTranslate() && (r = !1, T.params.resistance && (D = T.maxTranslate() + 1 - Math.pow(T.maxTranslate() - L - i, T.params.resistanceRatio))), r && (e.preventedByNestedSwiper = !0), !T.params.allowSwipeToNext && "next" === T.swipeDirection && D < L && (D = L), !T.params.allowSwipeToPrev && "prev" === T.swipeDirection && D > L && (D = L), T.params.threshold > 0) {
                                    if (!(Math.abs(i) > T.params.threshold || A))return void(D = L);
                                    if (!A)return A = !0, T.touches.startX = T.touches.currentX, T.touches.startY = T.touches.currentY, D = L, void(T.touches.diff = T.isHorizontal() ? T.touches.currentX - T.touches.startX : T.touches.currentY - T.touches.startY)
                                }
                                T.params.followFinger && ((T.params.freeMode || T.params.watchSlidesProgress) && T.updateActiveIndex(), T.params.freeMode && (0 === O.length && O.push({
                                    position: T.touches[T.isHorizontal() ? "startX" : "startY"],
                                    time: z
                                }), O.push({
                                    position: T.touches[T.isHorizontal() ? "currentX" : "currentY"],
                                    time: (new window.Date).getTime()
                                })), T.updateProgress(D), T.setWrapperTranslate(D))
                            }
                        }
                    }
                }
            }, T.onTouchEnd = function (e) {
                if (e.originalEvent && (e = e.originalEvent), M && T.emit("onTouchEnd", T, e), M = !1, k) {
                    T.params.grabCursor && E && k && (T.params.allowSwipeToNext === !0 || T.params.allowSwipeToPrev === !0) && T.setGrabCursor(!1);
                    var n = Date.now(), i = n - z;
                    if (T.allowClick && (T.updateClickedSlide(e), T.emit("onTap", T, e), i < 300 && n - N > 300 && (H && clearTimeout(H), H = setTimeout(function () {
                            T && (T.params.paginationHide && T.paginationContainer.length > 0 && !t(e.target).hasClass(T.params.bulletClass) && T.paginationContainer.toggleClass(T.params.paginationHiddenClass), T.emit("onClick", T, e))
                        }, 300)), i < 300 && n - N < 300 && (H && clearTimeout(H), T.emit("onDoubleTap", T, e))), N = Date.now(), setTimeout(function () {
                            T && (T.allowClick = !0)
                        }, 0), !k || !E || !T.swipeDirection || 0 === T.touches.diff || D === L)return void(k = E = !1);
                    k = E = !1;
                    var a;
                    if (a = T.params.followFinger ? T.rtl ? T.translate : -T.translate : -D, T.params.freeMode) {
                        if (a < -T.minTranslate())return void T.slideTo(T.activeIndex);
                        if (a > -T.maxTranslate())return void(T.slides.length < T.snapGrid.length ? T.slideTo(T.snapGrid.length - 1) : T.slideTo(T.slides.length - 1));
                        if (T.params.freeModeMomentum) {
                            if (O.length > 1) {
                                var r = O.pop(), o = O.pop(), s = r.position - o.position, l = r.time - o.time;
                                T.velocity = s / l, T.velocity = T.velocity / 2, Math.abs(T.velocity) < T.params.freeModeMinimumVelocity && (T.velocity = 0), (l > 150 || (new window.Date).getTime() - r.time > 300) && (T.velocity = 0)
                            } else T.velocity = 0;
                            T.velocity = T.velocity * T.params.freeModeMomentumVelocityRatio, O.length = 0;
                            var d = 1e3 * T.params.freeModeMomentumRatio, c = T.velocity * d, p = T.translate + c;
                            T.rtl && (p = -p);
                            var u, f = !1, h = 20 * Math.abs(T.velocity) * T.params.freeModeMomentumBounceRatio;
                            if (p < T.maxTranslate())T.params.freeModeMomentumBounce ? (p + T.maxTranslate() < -h && (p = T.maxTranslate() - h), u = T.maxTranslate(), f = !0, I = !0) : p = T.maxTranslate(); else if (p > T.minTranslate())T.params.freeModeMomentumBounce ? (p - T.minTranslate() > h && (p = T.minTranslate() + h), u = T.minTranslate(), f = !0, I = !0) : p = T.minTranslate(); else if (T.params.freeModeSticky) {
                                var m, g = 0;
                                for (g = 0; g < T.snapGrid.length; g += 1)if (T.snapGrid[g] > -p) {
                                    m = g;
                                    break
                                }
                                p = Math.abs(T.snapGrid[m] - p) < Math.abs(T.snapGrid[m - 1] - p) || "next" === T.swipeDirection ? T.snapGrid[m] : T.snapGrid[m - 1], T.rtl || (p = -p)
                            }
                            if (0 !== T.velocity)d = T.rtl ? Math.abs((-p - T.translate) / T.velocity) : Math.abs((p - T.translate) / T.velocity); else if (T.params.freeModeSticky)return void T.slideReset();
                            T.params.freeModeMomentumBounce && f ? (T.updateProgress(u), T.setWrapperTransition(d), T.setWrapperTranslate(p), T.onTransitionStart(), T.animating = !0, T.wrapper.transitionEnd(function () {
                                T && I && (T.emit("onMomentumBounce", T), T.setWrapperTransition(T.params.speed), T.setWrapperTranslate(u), T.wrapper.transitionEnd(function () {
                                    T && T.onTransitionEnd()
                                }))
                            })) : T.velocity ? (T.updateProgress(p), T.setWrapperTransition(d), T.setWrapperTranslate(p), T.onTransitionStart(), T.animating || (T.animating = !0, T.wrapper.transitionEnd(function () {
                                T && T.onTransitionEnd()
                            }))) : T.updateProgress(p), T.updateActiveIndex()
                        }
                        return void((!T.params.freeModeMomentum || i >= T.params.longSwipesMs) && (T.updateProgress(), T.updateActiveIndex()))
                    }
                    var v, y = 0, w = T.slidesSizesGrid[0];
                    for (v = 0; v < T.slidesGrid.length; v += T.params.slidesPerGroup)"undefined" != typeof T.slidesGrid[v + T.params.slidesPerGroup] ? a >= T.slidesGrid[v] && a < T.slidesGrid[v + T.params.slidesPerGroup] && (y = v,
                        w = T.slidesGrid[v + T.params.slidesPerGroup] - T.slidesGrid[v]) : a >= T.slidesGrid[v] && (y = v, w = T.slidesGrid[T.slidesGrid.length - 1] - T.slidesGrid[T.slidesGrid.length - 2]);
                    var x = (a - T.slidesGrid[y]) / w;
                    if (i > T.params.longSwipesMs) {
                        if (!T.params.longSwipes)return void T.slideTo(T.activeIndex);
                        "next" === T.swipeDirection && (x >= T.params.longSwipesRatio ? T.slideTo(y + T.params.slidesPerGroup) : T.slideTo(y)), "prev" === T.swipeDirection && (x > 1 - T.params.longSwipesRatio ? T.slideTo(y + T.params.slidesPerGroup) : T.slideTo(y))
                    } else {
                        if (!T.params.shortSwipes)return void T.slideTo(T.activeIndex);
                        "next" === T.swipeDirection && T.slideTo(y + T.params.slidesPerGroup), "prev" === T.swipeDirection && T.slideTo(y)
                    }
                }
            }, T._slideTo = function (e, t) {
                return T.slideTo(e, t, !0, !0)
            }, T.slideTo = function (e, t, n, i) {
                "undefined" == typeof n && (n = !0), "undefined" == typeof e && (e = 0), e < 0 && (e = 0), T.snapIndex = Math.floor(e / T.params.slidesPerGroup), T.snapIndex >= T.snapGrid.length && (T.snapIndex = T.snapGrid.length - 1);
                var a = -T.snapGrid[T.snapIndex];
                if (T.params.autoplay && T.autoplaying && (i || !T.params.autoplayDisableOnInteraction ? T.pauseAutoplay(t) : T.stopAutoplay()), T.updateProgress(a), T.params.normalizeSlideIndex)for (var r = 0; r < T.slidesGrid.length; r++)-Math.floor(100 * a) >= Math.floor(100 * T.slidesGrid[r]) && (e = r);
                return !(!T.params.allowSwipeToNext && a < T.translate && a < T.minTranslate()) && (!(!T.params.allowSwipeToPrev && a > T.translate && a > T.maxTranslate() && (T.activeIndex || 0) !== e) && ("undefined" == typeof t && (t = T.params.speed), T.previousIndex = T.activeIndex || 0, T.activeIndex = e, T.updateRealIndex(), T.rtl && -a === T.translate || !T.rtl && a === T.translate ? (T.params.autoHeight && T.updateAutoHeight(), T.updateClasses(), "slide" !== T.params.effect && T.setWrapperTranslate(a), !1) : (T.updateClasses(), T.onTransitionStart(n), 0 === t || T.browser.lteIE9 ? (T.setWrapperTranslate(a), T.setWrapperTransition(0), T.onTransitionEnd(n)) : (T.setWrapperTranslate(a), T.setWrapperTransition(t), T.animating || (T.animating = !0, T.wrapper.transitionEnd(function () {
                        T && T.onTransitionEnd(n)
                    }))), !0)))
            }, T.onTransitionStart = function (e) {
                "undefined" == typeof e && (e = !0), T.params.autoHeight && T.updateAutoHeight(), T.lazy && T.lazy.onTransitionStart(), e && (T.emit("onTransitionStart", T), T.activeIndex !== T.previousIndex && (T.emit("onSlideChangeStart", T), T.activeIndex > T.previousIndex ? T.emit("onSlideNextStart", T) : T.emit("onSlidePrevStart", T)))
            }, T.onTransitionEnd = function (e) {
                T.animating = !1, T.setWrapperTransition(0), "undefined" == typeof e && (e = !0), T.lazy && T.lazy.onTransitionEnd(), e && (T.emit("onTransitionEnd", T), T.activeIndex !== T.previousIndex && (T.emit("onSlideChangeEnd", T), T.activeIndex > T.previousIndex ? T.emit("onSlideNextEnd", T) : T.emit("onSlidePrevEnd", T))), T.params.history && T.history && T.history.setHistory(T.params.history, T.activeIndex), T.params.hashnav && T.hashnav && T.hashnav.setHash()
            }, T.slideNext = function (e, t, n) {
                if (T.params.loop) {
                    if (T.animating)return !1;
                    T.fixLoop();
                    T.container[0].clientLeft;
                    return T.slideTo(T.activeIndex + T.params.slidesPerGroup, t, e, n)
                }
                return T.slideTo(T.activeIndex + T.params.slidesPerGroup, t, e, n)
            }, T._slideNext = function (e) {
                return T.slideNext(!0, e, !0)
            }, T.slidePrev = function (e, t, n) {
                if (T.params.loop) {
                    if (T.animating)return !1;
                    T.fixLoop();
                    T.container[0].clientLeft;
                    return T.slideTo(T.activeIndex - 1, t, e, n)
                }
                return T.slideTo(T.activeIndex - 1, t, e, n)
            }, T._slidePrev = function (e) {
                return T.slidePrev(!0, e, !0)
            }, T.slideReset = function (e, t, n) {
                return T.slideTo(T.activeIndex, t, e)
            }, T.disableTouchControl = function () {
                return T.params.onlyExternal = !0, !0
            }, T.enableTouchControl = function () {
                return T.params.onlyExternal = !1, !0
            }, T.setWrapperTransition = function (e, t) {
                T.wrapper.transition(e), "slide" !== T.params.effect && T.effects[T.params.effect] && T.effects[T.params.effect].setTransition(e), T.params.parallax && T.parallax && T.parallax.setTransition(e), T.params.scrollbar && T.scrollbar && T.scrollbar.setTransition(e), T.params.control && T.controller && T.controller.setTransition(e, t), T.emit("onSetTransition", T, e)
            }, T.setWrapperTranslate = function (e, t, n) {
                var i = 0, a = 0, r = 0;
                T.isHorizontal() ? i = T.rtl ? -e : e : a = e, T.params.roundLengths && (i = o(i), a = o(a)), T.params.virtualTranslate || (T.support.transforms3d ? T.wrapper.transform("translate3d(" + i + "px, " + a + "px, " + r + "px)") : T.wrapper.transform("translate(" + i + "px, " + a + "px)")), T.translate = T.isHorizontal() ? i : a;
                var s, l = T.maxTranslate() - T.minTranslate();
                s = 0 === l ? 0 : (e - T.minTranslate()) / l, s !== T.progress && T.updateProgress(e), t && T.updateActiveIndex(), "slide" !== T.params.effect && T.effects[T.params.effect] && T.effects[T.params.effect].setTranslate(T.translate), T.params.parallax && T.parallax && T.parallax.setTranslate(T.translate), T.params.scrollbar && T.scrollbar && T.scrollbar.setTranslate(T.translate), T.params.control && T.controller && T.controller.setTranslate(T.translate, n), T.emit("onSetTranslate", T, T.translate)
            }, T.getTranslate = function (e, t) {
                var n, i, a, r;
                return "undefined" == typeof t && (t = "x"), T.params.virtualTranslate ? T.rtl ? -T.translate : T.translate : (a = window.getComputedStyle(e, null), window.WebKitCSSMatrix ? (i = a.transform || a.webkitTransform, i.split(",").length > 6 && (i = i.split(", ").map(function (e) {
                    return e.replace(",", ".")
                }).join(", ")), r = new window.WebKitCSSMatrix("none" === i ? "" : i)) : (r = a.MozTransform || a.OTransform || a.MsTransform || a.msTransform || a.transform || a.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,"), n = r.toString().split(",")), "x" === t && (i = window.WebKitCSSMatrix ? r.m41 : 16 === n.length ? parseFloat(n[12]) : parseFloat(n[4])), "y" === t && (i = window.WebKitCSSMatrix ? r.m42 : 16 === n.length ? parseFloat(n[13]) : parseFloat(n[5])), T.rtl && i && (i = -i), i || 0)
            }, T.getWrapperTranslate = function (e) {
                return "undefined" == typeof e && (e = T.isHorizontal() ? "x" : "y"), T.getTranslate(T.wrapper[0], e)
            }, T.observers = [], T.initObservers = function () {
                if (T.params.observeParents)for (var e = T.container.parents(), t = 0; t < e.length; t++)d(e[t]);
                d(T.container[0], {childList: !1}), d(T.wrapper[0], {attributes: !1})
            }, T.disconnectObservers = function () {
                for (var e = 0; e < T.observers.length; e++)T.observers[e].disconnect();
                T.observers = []
            }, T.createLoop = function () {
                T.wrapper.children("." + T.params.slideClass + "." + T.params.slideDuplicateClass).remove();
                var e = T.wrapper.children("." + T.params.slideClass);
                "auto" !== T.params.slidesPerView || T.params.loopedSlides || (T.params.loopedSlides = e.length), T.loopedSlides = parseInt(T.params.loopedSlides || T.params.slidesPerView, 10), T.loopedSlides = T.loopedSlides + T.params.loopAdditionalSlides, T.loopedSlides > e.length && (T.loopedSlides = e.length);
                var n, i = [], a = [];
                for (e.each(function (n, r) {
                    var o = t(this);
                    n < T.loopedSlides && a.push(r), n < e.length && n >= e.length - T.loopedSlides && i.push(r), o.attr("data-swiper-slide-index", n)
                }), n = 0; n < a.length; n++)T.wrapper.append(t(a[n].cloneNode(!0)).addClass(T.params.slideDuplicateClass));
                for (n = i.length - 1; n >= 0; n--)T.wrapper.prepend(t(i[n].cloneNode(!0)).addClass(T.params.slideDuplicateClass))
            }, T.destroyLoop = function () {
                T.wrapper.children("." + T.params.slideClass + "." + T.params.slideDuplicateClass).remove(), T.slides.removeAttr("data-swiper-slide-index")
            }, T.reLoop = function (e) {
                var t = T.activeIndex - T.loopedSlides;
                T.destroyLoop(), T.createLoop(), T.updateSlidesSize(), e && T.slideTo(t + T.loopedSlides, 0, !1)
            }, T.fixLoop = function () {
                var e;
                T.activeIndex < T.loopedSlides ? (e = T.slides.length - 3 * T.loopedSlides + T.activeIndex, e += T.loopedSlides, T.slideTo(e, 0, !1, !0)) : ("auto" === T.params.slidesPerView && T.activeIndex >= 2 * T.loopedSlides || T.activeIndex > T.slides.length - 2 * T.params.slidesPerView) && (e = -T.slides.length + T.activeIndex + T.loopedSlides, e += T.loopedSlides, T.slideTo(e, 0, !1, !0))
            }, T.appendSlide = function (e) {
                if (T.params.loop && T.destroyLoop(), "object" == typeof e && e.length)for (var t = 0; t < e.length; t++)e[t] && T.wrapper.append(e[t]); else T.wrapper.append(e);
                T.params.loop && T.createLoop(), T.params.observer && T.support.observer || T.update(!0)
            }, T.prependSlide = function (e) {
                T.params.loop && T.destroyLoop();
                var t = T.activeIndex + 1;
                if ("object" == typeof e && e.length) {
                    for (var n = 0; n < e.length; n++)e[n] && T.wrapper.prepend(e[n]);
                    t = T.activeIndex + e.length
                } else T.wrapper.prepend(e);
                T.params.loop && T.createLoop(), T.params.observer && T.support.observer || T.update(!0), T.slideTo(t, 0, !1)
            }, T.removeSlide = function (e) {
                T.params.loop && (T.destroyLoop(), T.slides = T.wrapper.children("." + T.params.slideClass));
                var t, n = T.activeIndex;
                if ("object" == typeof e && e.length) {
                    for (var i = 0; i < e.length; i++)t = e[i], T.slides[t] && T.slides.eq(t).remove(), t < n && n--;
                    n = Math.max(n, 0)
                } else t = e, T.slides[t] && T.slides.eq(t).remove(), t < n && n--, n = Math.max(n, 0);
                T.params.loop && T.createLoop(), T.params.observer && T.support.observer || T.update(!0), T.params.loop ? T.slideTo(n + T.loopedSlides, 0, !1) : T.slideTo(n, 0, !1)
            }, T.removeAllSlides = function () {
                for (var e = [], t = 0; t < T.slides.length; t++)e.push(t);
                T.removeSlide(e)
            }, T.effects = {
                fade: {
                    setTranslate: function () {
                        for (var e = 0; e < T.slides.length; e++) {
                            var t = T.slides.eq(e), n = t[0].swiperSlideOffset, i = -n;
                            T.params.virtualTranslate || (i -= T.translate);
                            var a = 0;
                            T.isHorizontal() || (a = i, i = 0);
                            var r = T.params.fade.crossFade ? Math.max(1 - Math.abs(t[0].progress), 0) : 1 + Math.min(Math.max(t[0].progress, -1), 0);
                            t.css({opacity: r}).transform("translate3d(" + i + "px, " + a + "px, 0px)")
                        }
                    }, setTransition: function (e) {
                        if (T.slides.transition(e), T.params.virtualTranslate && 0 !== e) {
                            var t = !1;
                            T.slides.transitionEnd(function () {
                                if (!t && T) {
                                    t = !0, T.animating = !1;
                                    for (var e = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], n = 0; n < e.length; n++)T.wrapper.trigger(e[n])
                                }
                            })
                        }
                    }
                }, flip: {
                    setTranslate: function () {
                        for (var e = 0; e < T.slides.length; e++) {
                            var n = T.slides.eq(e), i = n[0].progress;
                            T.params.flip.limitRotation && (i = Math.max(Math.min(n[0].progress, 1), -1));
                            var a = n[0].swiperSlideOffset, r = -180 * i, o = r, s = 0, l = -a, d = 0;
                            if (T.isHorizontal() ? T.rtl && (o = -o) : (d = l, l = 0, s = -o, o = 0), n[0].style.zIndex = -Math.abs(Math.round(i)) + T.slides.length, T.params.flip.slideShadows) {
                                var c = T.isHorizontal() ? n.find(".swiper-slide-shadow-left") : n.find(".swiper-slide-shadow-top"), p = T.isHorizontal() ? n.find(".swiper-slide-shadow-right") : n.find(".swiper-slide-shadow-bottom");
                                0 === c.length && (c = t('<div class="swiper-slide-shadow-' + (T.isHorizontal() ? "left" : "top") + '"></div>'), n.append(c)), 0 === p.length && (p = t('<div class="swiper-slide-shadow-' + (T.isHorizontal() ? "right" : "bottom") + '"></div>'), n.append(p)), c.length && (c[0].style.opacity = Math.max(-i, 0)), p.length && (p[0].style.opacity = Math.max(i, 0))
                            }
                            n.transform("translate3d(" + l + "px, " + d + "px, 0px) rotateX(" + s + "deg) rotateY(" + o + "deg)")
                        }
                    }, setTransition: function (e) {
                        if (T.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), T.params.virtualTranslate && 0 !== e) {
                            var n = !1;
                            T.slides.eq(T.activeIndex).transitionEnd(function () {
                                if (!n && T && t(this).hasClass(T.params.slideActiveClass)) {
                                    n = !0, T.animating = !1;
                                    for (var e = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], i = 0; i < e.length; i++)T.wrapper.trigger(e[i])
                                }
                            })
                        }
                    }
                }, cube: {
                    setTranslate: function () {
                        var e, n = 0;
                        T.params.cube.shadow && (T.isHorizontal() ? (e = T.wrapper.find(".swiper-cube-shadow"), 0 === e.length && (e = t('<div class="swiper-cube-shadow"></div>'), T.wrapper.append(e)), e.css({height: T.width + "px"})) : (e = T.container.find(".swiper-cube-shadow"), 0 === e.length && (e = t('<div class="swiper-cube-shadow"></div>'), T.container.append(e))));
                        for (var i = 0; i < T.slides.length; i++) {
                            var a = T.slides.eq(i), r = 90 * i, o = Math.floor(r / 360);
                            T.rtl && (r = -r, o = Math.floor(-r / 360));
                            var s = Math.max(Math.min(a[0].progress, 1), -1), l = 0, d = 0, c = 0;
                            i % 4 === 0 ? (l = 4 * -o * T.size, c = 0) : (i - 1) % 4 === 0 ? (l = 0, c = 4 * -o * T.size) : (i - 2) % 4 === 0 ? (l = T.size + 4 * o * T.size, c = T.size) : (i - 3) % 4 === 0 && (l = -T.size, c = 3 * T.size + 4 * T.size * o), T.rtl && (l = -l), T.isHorizontal() || (d = l, l = 0);
                            var p = "rotateX(" + (T.isHorizontal() ? 0 : -r) + "deg) rotateY(" + (T.isHorizontal() ? r : 0) + "deg) translate3d(" + l + "px, " + d + "px, " + c + "px)";
                            if (s <= 1 && s > -1 && (n = 90 * i + 90 * s, T.rtl && (n = 90 * -i - 90 * s)), a.transform(p), T.params.cube.slideShadows) {
                                var u = T.isHorizontal() ? a.find(".swiper-slide-shadow-left") : a.find(".swiper-slide-shadow-top"), f = T.isHorizontal() ? a.find(".swiper-slide-shadow-right") : a.find(".swiper-slide-shadow-bottom");
                                0 === u.length && (u = t('<div class="swiper-slide-shadow-' + (T.isHorizontal() ? "left" : "top") + '"></div>'), a.append(u)), 0 === f.length && (f = t('<div class="swiper-slide-shadow-' + (T.isHorizontal() ? "right" : "bottom") + '"></div>'), a.append(f)), u.length && (u[0].style.opacity = Math.max(-s, 0)), f.length && (f[0].style.opacity = Math.max(s, 0))
                            }
                        }
                        if (T.wrapper.css({
                                "-webkit-transform-origin": "50% 50% -" + T.size / 2 + "px",
                                "-moz-transform-origin": "50% 50% -" + T.size / 2 + "px",
                                "-ms-transform-origin": "50% 50% -" + T.size / 2 + "px",
                                "transform-origin": "50% 50% -" + T.size / 2 + "px"
                            }), T.params.cube.shadow)if (T.isHorizontal())e.transform("translate3d(0px, " + (T.width / 2 + T.params.cube.shadowOffset) + "px, " + -T.width / 2 + "px) rotateX(90deg) rotateZ(0deg) scale(" + T.params.cube.shadowScale + ")"); else {
                            var h = Math.abs(n) - 90 * Math.floor(Math.abs(n) / 90), m = 1.5 - (Math.sin(2 * h * Math.PI / 360) / 2 + Math.cos(2 * h * Math.PI / 360) / 2), g = T.params.cube.shadowScale, v = T.params.cube.shadowScale / m, y = T.params.cube.shadowOffset;
                            e.transform("scale3d(" + g + ", 1, " + v + ") translate3d(0px, " + (T.height / 2 + y) + "px, " + -T.height / 2 / v + "px) rotateX(-90deg)")
                        }
                        var w = T.isSafari || T.isUiWebView ? -T.size / 2 : 0;
                        T.wrapper.transform("translate3d(0px,0," + w + "px) rotateX(" + (T.isHorizontal() ? 0 : n) + "deg) rotateY(" + (T.isHorizontal() ? -n : 0) + "deg)")
                    }, setTransition: function (e) {
                        T.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), T.params.cube.shadow && !T.isHorizontal() && T.container.find(".swiper-cube-shadow").transition(e)
                    }
                }, coverflow: {
                    setTranslate: function () {
                        for (var e = T.translate, n = T.isHorizontal() ? -e + T.width / 2 : -e + T.height / 2, i = T.isHorizontal() ? T.params.coverflow.rotate : -T.params.coverflow.rotate, a = T.params.coverflow.depth, r = 0, o = T.slides.length; r < o; r++) {
                            var s = T.slides.eq(r), l = T.slidesSizesGrid[r], d = s[0].swiperSlideOffset, c = (n - d - l / 2) / l * T.params.coverflow.modifier, p = T.isHorizontal() ? i * c : 0, u = T.isHorizontal() ? 0 : i * c, f = -a * Math.abs(c), h = T.isHorizontal() ? 0 : T.params.coverflow.stretch * c, m = T.isHorizontal() ? T.params.coverflow.stretch * c : 0;
                            Math.abs(m) < .001 && (m = 0), Math.abs(h) < .001 && (h = 0), Math.abs(f) < .001 && (f = 0), Math.abs(p) < .001 && (p = 0), Math.abs(u) < .001 && (u = 0);
                            var g = "translate3d(" + m + "px," + h + "px," + f + "px)  rotateX(" + u + "deg) rotateY(" + p + "deg)";
                            if (s.transform(g), s[0].style.zIndex = -Math.abs(Math.round(c)) + 1, T.params.coverflow.slideShadows) {
                                var v = T.isHorizontal() ? s.find(".swiper-slide-shadow-left") : s.find(".swiper-slide-shadow-top"), y = T.isHorizontal() ? s.find(".swiper-slide-shadow-right") : s.find(".swiper-slide-shadow-bottom");
                                0 === v.length && (v = t('<div class="swiper-slide-shadow-' + (T.isHorizontal() ? "left" : "top") + '"></div>'), s.append(v)), 0 === y.length && (y = t('<div class="swiper-slide-shadow-' + (T.isHorizontal() ? "right" : "bottom") + '"></div>'), s.append(y)), v.length && (v[0].style.opacity = c > 0 ? c : 0), y.length && (y[0].style.opacity = -c > 0 ? -c : 0)
                            }
                        }
                        if (T.browser.ie) {
                            var w = T.wrapper[0].style;
                            w.perspectiveOrigin = n + "px 50%"
                        }
                    }, setTransition: function (e) {
                        T.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)
                    }
                }
            }, T.lazy = {
                initialImageLoaded: !1, loadImageInSlide: function (e, n) {
                    if ("undefined" != typeof e && ("undefined" == typeof n && (n = !0), 0 !== T.slides.length)) {
                        var i = T.slides.eq(e), a = i.find("." + T.params.lazyLoadingClass + ":not(." + T.params.lazyStatusLoadedClass + "):not(." + T.params.lazyStatusLoadingClass + ")");
                        !i.hasClass(T.params.lazyLoadingClass) || i.hasClass(T.params.lazyStatusLoadedClass) || i.hasClass(T.params.lazyStatusLoadingClass) || (a = a.add(i[0])), 0 !== a.length && a.each(function () {
                            var e = t(this);
                            e.addClass(T.params.lazyStatusLoadingClass);
                            var a = e.attr("data-background"), r = e.attr("data-src"), o = e.attr("data-srcset"), s = e.attr("data-sizes");
                            T.loadImage(e[0], r || a, o, s, !1, function () {
                                if (a ? (e.css("background-image", 'url("' + a + '")'), e.removeAttr("data-background")) : (o && (e.attr("srcset", o), e.removeAttr("data-srcset")), s && (e.attr("sizes", s), e.removeAttr("data-sizes")), r && (e.attr("src", r), e.removeAttr("data-src"))), e.addClass(T.params.lazyStatusLoadedClass).removeClass(T.params.lazyStatusLoadingClass), i.find("." + T.params.lazyPreloaderClass + ", ." + T.params.preloaderClass).remove(), T.params.loop && n) {
                                    var t = i.attr("data-swiper-slide-index");
                                    if (i.hasClass(T.params.slideDuplicateClass)) {
                                        var l = T.wrapper.children('[data-swiper-slide-index="' + t + '"]:not(.' + T.params.slideDuplicateClass + ")");
                                        T.lazy.loadImageInSlide(l.index(), !1)
                                    } else {
                                        var d = T.wrapper.children("." + T.params.slideDuplicateClass + '[data-swiper-slide-index="' + t + '"]');
                                        T.lazy.loadImageInSlide(d.index(), !1)
                                    }
                                }
                                T.emit("onLazyImageReady", T, i[0], e[0])
                            }), T.emit("onLazyImageLoad", T, i[0], e[0])
                        })
                    }
                }, load: function () {
                    var e, n = T.params.slidesPerView;
                    if ("auto" === n && (n = 0), T.lazy.initialImageLoaded || (T.lazy.initialImageLoaded = !0), T.params.watchSlidesVisibility)T.wrapper.children("." + T.params.slideVisibleClass).each(function () {
                        T.lazy.loadImageInSlide(t(this).index())
                    }); else if (n > 1)for (e = T.activeIndex; e < T.activeIndex + n; e++)T.slides[e] && T.lazy.loadImageInSlide(e); else T.lazy.loadImageInSlide(T.activeIndex);
                    if (T.params.lazyLoadingInPrevNext)if (n > 1 || T.params.lazyLoadingInPrevNextAmount && T.params.lazyLoadingInPrevNextAmount > 1) {
                        var i = T.params.lazyLoadingInPrevNextAmount, a = n, r = Math.min(T.activeIndex + a + Math.max(i, a), T.slides.length), o = Math.max(T.activeIndex - Math.max(a, i), 0);
                        for (e = T.activeIndex + n; e < r; e++)T.slides[e] && T.lazy.loadImageInSlide(e);
                        for (e = o; e < T.activeIndex; e++)T.slides[e] && T.lazy.loadImageInSlide(e)
                    } else {
                        var s = T.wrapper.children("." + T.params.slideNextClass);
                        s.length > 0 && T.lazy.loadImageInSlide(s.index());
                        var l = T.wrapper.children("." + T.params.slidePrevClass);
                        l.length > 0 && T.lazy.loadImageInSlide(l.index())
                    }
                }, onTransitionStart: function () {
                    T.params.lazyLoading && (T.params.lazyLoadingOnTransitionStart || !T.params.lazyLoadingOnTransitionStart && !T.lazy.initialImageLoaded) && T.lazy.load()
                }, onTransitionEnd: function () {
                    T.params.lazyLoading && !T.params.lazyLoadingOnTransitionStart && T.lazy.load()
                }
            }, T.scrollbar = {
                isTouched: !1, setDragPosition: function (e) {
                    var t = T.scrollbar, n = T.isHorizontal() ? "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX || e.clientX : "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY || e.clientY, i = n - t.track.offset()[T.isHorizontal() ? "left" : "top"] - t.dragSize / 2, a = -T.minTranslate() * t.moveDivider, r = -T.maxTranslate() * t.moveDivider;
                    i < a ? i = a : i > r && (i = r), i = -i / t.moveDivider, T.updateProgress(i), T.setWrapperTranslate(i, !0)
                }, dragStart: function (e) {
                    var t = T.scrollbar;
                    t.isTouched = !0, e.preventDefault(), e.stopPropagation(), t.setDragPosition(e), clearTimeout(t.dragTimeout), t.track.transition(0), T.params.scrollbarHide && t.track.css("opacity", 1), T.wrapper.transition(100), t.drag.transition(100), T.emit("onScrollbarDragStart", T)
                }, dragMove: function (e) {
                    var t = T.scrollbar;
                    t.isTouched && (e.preventDefault ? e.preventDefault() : e.returnValue = !1, t.setDragPosition(e), T.wrapper.transition(0), t.track.transition(0), t.drag.transition(0), T.emit("onScrollbarDragMove", T))
                }, dragEnd: function (e) {
                    var t = T.scrollbar;
                    t.isTouched && (t.isTouched = !1, T.params.scrollbarHide && (clearTimeout(t.dragTimeout), t.dragTimeout = setTimeout(function () {
                        t.track.css("opacity", 0), t.track.transition(400)
                    }, 1e3)), T.emit("onScrollbarDragEnd", T), T.params.scrollbarSnapOnRelease && T.slideReset())
                }, draggableEvents: function () {
                    return T.params.simulateTouch !== !1 || T.support.touch ? T.touchEvents : T.touchEventsDesktop
                }(), enableDraggable: function () {
                    var e = T.scrollbar, n = T.support.touch ? e.track : document;
                    t(e.track).on(e.draggableEvents.start, e.dragStart), t(n).on(e.draggableEvents.move, e.dragMove), t(n).on(e.draggableEvents.end, e.dragEnd)
                }, disableDraggable: function () {
                    var e = T.scrollbar, n = T.support.touch ? e.track : document;
                    t(e.track).off(T.draggableEvents.start, e.dragStart), t(n).off(T.draggableEvents.move, e.dragMove), t(n).off(T.draggableEvents.end, e.dragEnd)
                }, set: function () {
                    if (T.params.scrollbar) {
                        var e = T.scrollbar;
                        e.track = t(T.params.scrollbar), T.params.uniqueNavElements && "string" == typeof T.params.scrollbar && e.track.length > 1 && 1 === T.container.find(T.params.scrollbar).length && (e.track = T.container.find(T.params.scrollbar)), e.drag = e.track.find(".swiper-scrollbar-drag"), 0 === e.drag.length && (e.drag = t('<div class="swiper-scrollbar-drag"></div>'), e.track.append(e.drag)), e.drag[0].style.width = "", e.drag[0].style.height = "", e.trackSize = T.isHorizontal() ? e.track[0].offsetWidth : e.track[0].offsetHeight, e.divider = T.size / T.virtualSize, e.moveDivider = e.divider * (e.trackSize / T.size), e.dragSize = e.trackSize * e.divider, T.isHorizontal() ? e.drag[0].style.width = e.dragSize + "px" : e.drag[0].style.height = e.dragSize + "px", e.divider >= 1 ? e.track[0].style.display = "none" : e.track[0].style.display = "", T.params.scrollbarHide && (e.track[0].style.opacity = 0)
                    }
                }, setTranslate: function () {
                    if (T.params.scrollbar) {
                        var e, t = T.scrollbar, n = (T.translate || 0, t.dragSize);
                        e = (t.trackSize - t.dragSize) * T.progress, T.rtl && T.isHorizontal() ? (e = -e, e > 0 ? (n = t.dragSize - e, e = 0) : -e + t.dragSize > t.trackSize && (n = t.trackSize + e)) : e < 0 ? (n = t.dragSize + e, e = 0) : e + t.dragSize > t.trackSize && (n = t.trackSize - e), T.isHorizontal() ? (T.support.transforms3d ? t.drag.transform("translate3d(" + e + "px, 0, 0)") : t.drag.transform("translateX(" + e + "px)"), t.drag[0].style.width = n + "px") : (T.support.transforms3d ? t.drag.transform("translate3d(0px, " + e + "px, 0)") : t.drag.transform("translateY(" + e + "px)"), t.drag[0].style.height = n + "px"), T.params.scrollbarHide && (clearTimeout(t.timeout), t.track[0].style.opacity = 1, t.timeout = setTimeout(function () {
                            t.track[0].style.opacity = 0, t.track.transition(400)
                        }, 1e3))
                    }
                }, setTransition: function (e) {
                    T.params.scrollbar && T.scrollbar.drag.transition(e)
                }
            }, T.controller = {
                LinearSpline: function (e, t) {
                    this.x = e, this.y = t, this.lastIndex = e.length - 1;
                    var n, i;
                    this.x.length;
                    this.interpolate = function (e) {
                        return e ? (i = a(this.x, e), n = i - 1, (e - this.x[n]) * (this.y[i] - this.y[n]) / (this.x[i] - this.x[n]) + this.y[n]) : 0
                    };
                    var a = function () {
                        var e, t, n;
                        return function (i, a) {
                            for (t = -1, e = i.length; e - t > 1;)i[n = e + t >> 1] <= a ? t = n : e = n;
                            return e
                        }
                    }()
                }, getInterpolateFunction: function (e) {
                    T.controller.spline || (T.controller.spline = T.params.loop ? new T.controller.LinearSpline(T.slidesGrid, e.slidesGrid) : new T.controller.LinearSpline(T.snapGrid, e.snapGrid))
                }, setTranslate: function (e, t) {
                    function i(t) {
                        e = t.rtl && "horizontal" === t.params.direction ? -T.translate : T.translate, "slide" === T.params.controlBy && (T.controller.getInterpolateFunction(t), r = -T.controller.spline.interpolate(-e)), r && "container" !== T.params.controlBy || (a = (t.maxTranslate() - t.minTranslate()) / (T.maxTranslate() - T.minTranslate()), r = (e - T.minTranslate()) * a + t.minTranslate()), T.params.controlInverse && (r = t.maxTranslate() - r), t.updateProgress(r), t.setWrapperTranslate(r, !1, T), t.updateActiveIndex()
                    }

                    var a, r, o = T.params.control;
                    if (T.isArray(o))for (var s = 0; s < o.length; s++)o[s] !== t && o[s] instanceof n && i(o[s]); else o instanceof n && t !== o && i(o)
                }, setTransition: function (e, t) {
                    function i(t) {
                        t.setWrapperTransition(e, T), 0 !== e && (t.onTransitionStart(), t.wrapper.transitionEnd(function () {
                            r && (t.params.loop && "slide" === T.params.controlBy && t.fixLoop(), t.onTransitionEnd())
                        }))
                    }

                    var a, r = T.params.control;
                    if (T.isArray(r))for (a = 0; a < r.length; a++)r[a] !== t && r[a] instanceof n && i(r[a]); else r instanceof n && t !== r && i(r)
                }
            }, T.hashnav = {
                onHashCange: function (e, t) {
                    var n = document.location.hash.replace("#", ""), i = T.slides.eq(T.activeIndex).attr("data-hash");
                    n !== i && T.slideTo(T.wrapper.children("." + T.params.slideClass + '[data-hash="' + n + '"]').index())
                }, attachEvents: function (e) {
                    var n = e ? "off" : "on";
                    t(window)[n]("hashchange", T.hashnav.onHashCange)
                }, setHash: function () {
                    if (T.hashnav.initialized && T.params.hashnav)if (T.params.replaceState && window.history && window.history.replaceState)window.history.replaceState(null, null, "#" + T.slides.eq(T.activeIndex).attr("data-hash") || ""); else {
                        var e = T.slides.eq(T.activeIndex), t = e.attr("data-hash") || e.attr("data-history");
                        document.location.hash = t || ""
                    }
                }, init: function () {
                    if (T.params.hashnav && !T.params.history) {
                        T.hashnav.initialized = !0;
                        var e = document.location.hash.replace("#", "");
                        if (e) {
                            for (var t = 0, n = 0, i = T.slides.length; n < i; n++) {
                                var a = T.slides.eq(n), r = a.attr("data-hash") || a.attr("data-history");
                                if (r === e && !a.hasClass(T.params.slideDuplicateClass)) {
                                    var o = a.index();
                                    T.slideTo(o, t, T.params.runCallbacksOnInit, !0)
                                }
                            }
                            T.params.hashnavWatchState && T.hashnav.attachEvents()
                        }
                    }
                }, destroy: function () {
                    T.params.hashnavWatchState && T.hashnav.attachEvents(!0)
                }
            }, T.history = {
                init: function () {
                    if (T.params.history) {
                        if (!window.history || !window.history.pushState)return T.params.history = !1, void(T.params.hashnav = !0);
                        T.history.initialized = !0, this.paths = this.getPathValues(), (this.paths.key || this.paths.value) && (this.scrollToSlide(0, this.paths.value, T.params.runCallbacksOnInit), T.params.replaceState || window.addEventListener("popstate", this.setHistoryPopState))
                    }
                }, setHistoryPopState: function () {
                    T.history.paths = T.history.getPathValues(), T.history.scrollToSlide(T.params.speed, T.history.paths.value, !1)
                }, getPathValues: function () {
                    var e = window.location.pathname.slice(1).split("/"), t = e.length, n = e[t - 2], i = e[t - 1];
                    return {key: n, value: i}
                }, setHistory: function (e, t) {
                    if (T.history.initialized && T.params.history) {
                        var n = T.slides.eq(t), i = this.slugify(n.attr("data-history"));
                        window.location.pathname.includes(e) || (i = e + "/" + i), T.params.replaceState ? window.history.replaceState(null, null, i) : window.history.pushState(null, null, i)
                    }
                }, slugify: function (e) {
                    return e.toString().toLowerCase().replace(/\s+/g, "-").replace(/[^\w\-]+/g, "").replace(/\-\-+/g, "-").replace(/^-+/, "").replace(/-+$/, "")
                }, scrollToSlide: function (e, t, n) {
                    if (t)for (var i = 0, a = T.slides.length; i < a; i++) {
                        var r = T.slides.eq(i), o = this.slugify(r.attr("data-history"));
                        if (o === t && !r.hasClass(T.params.slideDuplicateClass)) {
                            var s = r.index();
                            T.slideTo(s, e, n)
                        }
                    } else T.slideTo(0, e, n)
                }
            }, T.disableKeyboardControl = function () {
                T.params.keyboardControl = !1, t(document).off("keydown", c)
            }, T.enableKeyboardControl = function () {
                T.params.keyboardControl = !0, t(document).on("keydown", c)
            }, T.mousewheel = {
                event: !1,
                lastScrollTime: (new window.Date).getTime()
            }, T.params.mousewheelControl && (T.mousewheel.event = navigator.userAgent.indexOf("firefox") > -1 ? "DOMMouseScroll" : p() ? "wheel" : "mousewheel"), T.disableMousewheelControl = function () {
                if (!T.mousewheel.event)return !1;
                var e = T.container;
                return "container" !== T.params.mousewheelEventsTarged && (e = t(T.params.mousewheelEventsTarged)), e.off(T.mousewheel.event, u), !0
            }, T.enableMousewheelControl = function () {
                if (!T.mousewheel.event)return !1;
                var e = T.container;
                return "container" !== T.params.mousewheelEventsTarged && (e = t(T.params.mousewheelEventsTarged)), e.on(T.mousewheel.event, u), !0
            }, T.parallax = {
                setTranslate: function () {
                    T.container.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function () {
                        h(this, T.progress)
                    }), T.slides.each(function () {
                        var e = t(this);
                        e.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function () {
                            var t = Math.min(Math.max(e[0].progress, -1), 1);
                            h(this, t)
                        })
                    })
                }, setTransition: function (e) {
                    "undefined" == typeof e && (e = T.params.speed), T.container.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function () {
                        var n = t(this), i = parseInt(n.attr("data-swiper-parallax-duration"), 10) || e;
                        0 === e && (i = 0), n.transition(i)
                    })
                }
            }, T.zoom = {
                scale: 1,
                currentScale: 1,
                isScaling: !1,
                gesture: {
                    slide: void 0,
                    slideWidth: void 0,
                    slideHeight: void 0,
                    image: void 0,
                    imageWrap: void 0,
                    zoomMax: T.params.zoomMax
                },
                image: {
                    isTouched: void 0,
                    isMoved: void 0,
                    currentX: void 0,
                    currentY: void 0,
                    minX: void 0,
                    minY: void 0,
                    maxX: void 0,
                    maxY: void 0,
                    width: void 0,
                    height: void 0,
                    startX: void 0,
                    startY: void 0,
                    touchesStart: {},
                    touchesCurrent: {}
                },
                velocity: {x: void 0, y: void 0, prevPositionX: void 0, prevPositionY: void 0, prevTime: void 0},
                getDistanceBetweenTouches: function (e) {
                    if (e.targetTouches.length < 2)return 1;
                    var t = e.targetTouches[0].pageX, n = e.targetTouches[0].pageY, i = e.targetTouches[1].pageX, a = e.targetTouches[1].pageY, r = Math.sqrt(Math.pow(i - t, 2) + Math.pow(a - n, 2));
                    return r
                },
                onGestureStart: function (e) {
                    var n = T.zoom;
                    if (!T.support.gestures) {
                        if ("touchstart" !== e.type || "touchstart" === e.type && e.targetTouches.length < 2)return;
                        n.gesture.scaleStart = n.getDistanceBetweenTouches(e)
                    }
                    return n.gesture.slide && n.gesture.slide.length || (n.gesture.slide = t(this), 0 === n.gesture.slide.length && (n.gesture.slide = T.slides.eq(T.activeIndex)), n.gesture.image = n.gesture.slide.find("img, svg, canvas"), n.gesture.imageWrap = n.gesture.image.parent("." + T.params.zoomContainerClass), n.gesture.zoomMax = n.gesture.imageWrap.attr("data-swiper-zoom") || T.params.zoomMax, 0 !== n.gesture.imageWrap.length) ? (n.gesture.image.transition(0), void(n.isScaling = !0)) : void(n.gesture.image = void 0)
                },
                onGestureChange: function (e) {
                    var t = T.zoom;
                    if (!T.support.gestures) {
                        if ("touchmove" !== e.type || "touchmove" === e.type && e.targetTouches.length < 2)return;
                        t.gesture.scaleMove = t.getDistanceBetweenTouches(e)
                    }
                    t.gesture.image && 0 !== t.gesture.image.length && (T.support.gestures ? t.scale = e.scale * t.currentScale : t.scale = t.gesture.scaleMove / t.gesture.scaleStart * t.currentScale, t.scale > t.gesture.zoomMax && (t.scale = t.gesture.zoomMax - 1 + Math.pow(t.scale - t.gesture.zoomMax + 1, .5)), t.scale < T.params.zoomMin && (t.scale = T.params.zoomMin + 1 - Math.pow(T.params.zoomMin - t.scale + 1, .5)), t.gesture.image.transform("translate3d(0,0,0) scale(" + t.scale + ")"))
                },
                onGestureEnd: function (e) {
                    var t = T.zoom;
                    !T.support.gestures && ("touchend" !== e.type || "touchend" === e.type && e.changedTouches.length < 2) || t.gesture.image && 0 !== t.gesture.image.length && (t.scale = Math.max(Math.min(t.scale, t.gesture.zoomMax), T.params.zoomMin), t.gesture.image.transition(T.params.speed).transform("translate3d(0,0,0) scale(" + t.scale + ")"), t.currentScale = t.scale, t.isScaling = !1, 1 === t.scale && (t.gesture.slide = void 0))
                },
                onTouchStart: function (e, t) {
                    var n = e.zoom;
                    n.gesture.image && 0 !== n.gesture.image.length && (n.image.isTouched || ("android" === e.device.os && t.preventDefault(), n.image.isTouched = !0, n.image.touchesStart.x = "touchstart" === t.type ? t.targetTouches[0].pageX : t.pageX, n.image.touchesStart.y = "touchstart" === t.type ? t.targetTouches[0].pageY : t.pageY))
                },
                onTouchMove: function (e) {
                    var t = T.zoom;
                    if (t.gesture.image && 0 !== t.gesture.image.length && (T.allowClick = !1, t.image.isTouched && t.gesture.slide)) {
                        t.image.isMoved || (t.image.width = t.gesture.image[0].offsetWidth, t.image.height = t.gesture.image[0].offsetHeight, t.image.startX = T.getTranslate(t.gesture.imageWrap[0], "x") || 0, t.image.startY = T.getTranslate(t.gesture.imageWrap[0], "y") || 0, t.gesture.slideWidth = t.gesture.slide[0].offsetWidth, t.gesture.slideHeight = t.gesture.slide[0].offsetHeight, t.gesture.imageWrap.transition(0));
                        var n = t.image.width * t.scale, i = t.image.height * t.scale;
                        if (!(n < t.gesture.slideWidth && i < t.gesture.slideHeight)) {
                            if (t.image.minX = Math.min(t.gesture.slideWidth / 2 - n / 2, 0), t.image.maxX = -t.image.minX, t.image.minY = Math.min(t.gesture.slideHeight / 2 - i / 2, 0), t.image.maxY = -t.image.minY, t.image.touchesCurrent.x = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, t.image.touchesCurrent.y = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, !t.image.isMoved && !t.isScaling) {
                                if (T.isHorizontal() && Math.floor(t.image.minX) === Math.floor(t.image.startX) && t.image.touchesCurrent.x < t.image.touchesStart.x || Math.floor(t.image.maxX) === Math.floor(t.image.startX) && t.image.touchesCurrent.x > t.image.touchesStart.x)return void(t.image.isTouched = !1);
                                if (!T.isHorizontal() && Math.floor(t.image.minY) === Math.floor(t.image.startY) && t.image.touchesCurrent.y < t.image.touchesStart.y || Math.floor(t.image.maxY) === Math.floor(t.image.startY) && t.image.touchesCurrent.y > t.image.touchesStart.y)return void(t.image.isTouched = !1)
                            }
                            e.preventDefault(), e.stopPropagation(), t.image.isMoved = !0, t.image.currentX = t.image.touchesCurrent.x - t.image.touchesStart.x + t.image.startX, t.image.currentY = t.image.touchesCurrent.y - t.image.touchesStart.y + t.image.startY, t.image.currentX < t.image.minX && (t.image.currentX = t.image.minX + 1 - Math.pow(t.image.minX - t.image.currentX + 1, .8)), t.image.currentX > t.image.maxX && (t.image.currentX = t.image.maxX - 1 + Math.pow(t.image.currentX - t.image.maxX + 1, .8)), t.image.currentY < t.image.minY && (t.image.currentY = t.image.minY + 1 - Math.pow(t.image.minY - t.image.currentY + 1, .8)), t.image.currentY > t.image.maxY && (t.image.currentY = t.image.maxY - 1 + Math.pow(t.image.currentY - t.image.maxY + 1, .8)), t.velocity.prevPositionX || (t.velocity.prevPositionX = t.image.touchesCurrent.x), t.velocity.prevPositionY || (t.velocity.prevPositionY = t.image.touchesCurrent.y), t.velocity.prevTime || (t.velocity.prevTime = Date.now()), t.velocity.x = (t.image.touchesCurrent.x - t.velocity.prevPositionX) / (Date.now() - t.velocity.prevTime) / 2, t.velocity.y = (t.image.touchesCurrent.y - t.velocity.prevPositionY) / (Date.now() - t.velocity.prevTime) / 2,
                            Math.abs(t.image.touchesCurrent.x - t.velocity.prevPositionX) < 2 && (t.velocity.x = 0), Math.abs(t.image.touchesCurrent.y - t.velocity.prevPositionY) < 2 && (t.velocity.y = 0), t.velocity.prevPositionX = t.image.touchesCurrent.x, t.velocity.prevPositionY = t.image.touchesCurrent.y, t.velocity.prevTime = Date.now(), t.gesture.imageWrap.transform("translate3d(" + t.image.currentX + "px, " + t.image.currentY + "px,0)")
                        }
                    }
                },
                onTouchEnd: function (e, t) {
                    var n = e.zoom;
                    if (n.gesture.image && 0 !== n.gesture.image.length) {
                        if (!n.image.isTouched || !n.image.isMoved)return n.image.isTouched = !1, void(n.image.isMoved = !1);
                        n.image.isTouched = !1, n.image.isMoved = !1;
                        var i = 300, a = 300, r = n.velocity.x * i, o = n.image.currentX + r, s = n.velocity.y * a, l = n.image.currentY + s;
                        0 !== n.velocity.x && (i = Math.abs((o - n.image.currentX) / n.velocity.x)), 0 !== n.velocity.y && (a = Math.abs((l - n.image.currentY) / n.velocity.y));
                        var d = Math.max(i, a);
                        n.image.currentX = o, n.image.currentY = l;
                        var c = n.image.width * n.scale, p = n.image.height * n.scale;
                        n.image.minX = Math.min(n.gesture.slideWidth / 2 - c / 2, 0), n.image.maxX = -n.image.minX, n.image.minY = Math.min(n.gesture.slideHeight / 2 - p / 2, 0), n.image.maxY = -n.image.minY, n.image.currentX = Math.max(Math.min(n.image.currentX, n.image.maxX), n.image.minX), n.image.currentY = Math.max(Math.min(n.image.currentY, n.image.maxY), n.image.minY), n.gesture.imageWrap.transition(d).transform("translate3d(" + n.image.currentX + "px, " + n.image.currentY + "px,0)")
                    }
                },
                onTransitionEnd: function (e) {
                    var t = e.zoom;
                    t.gesture.slide && e.previousIndex !== e.activeIndex && (t.gesture.image.transform("translate3d(0,0,0) scale(1)"), t.gesture.imageWrap.transform("translate3d(0,0,0)"), t.gesture.slide = t.gesture.image = t.gesture.imageWrap = void 0, t.scale = t.currentScale = 1)
                },
                toggleZoom: function (e, n) {
                    var i = e.zoom;
                    if (i.gesture.slide || (i.gesture.slide = e.clickedSlide ? t(e.clickedSlide) : e.slides.eq(e.activeIndex), i.gesture.image = i.gesture.slide.find("img, svg, canvas"), i.gesture.imageWrap = i.gesture.image.parent("." + e.params.zoomContainerClass)), i.gesture.image && 0 !== i.gesture.image.length) {
                        var a, r, o, s, l, d, c, p, u, f, h, m, g, v, y, w, x, b;
                        "undefined" == typeof i.image.touchesStart.x && n ? (a = "touchend" === n.type ? n.changedTouches[0].pageX : n.pageX, r = "touchend" === n.type ? n.changedTouches[0].pageY : n.pageY) : (a = i.image.touchesStart.x, r = i.image.touchesStart.y), i.scale && 1 !== i.scale ? (i.scale = i.currentScale = 1, i.gesture.imageWrap.transition(300).transform("translate3d(0,0,0)"), i.gesture.image.transition(300).transform("translate3d(0,0,0) scale(1)"), i.gesture.slide = void 0) : (i.scale = i.currentScale = i.gesture.imageWrap.attr("data-swiper-zoom") || e.params.zoomMax, n ? (x = i.gesture.slide[0].offsetWidth, b = i.gesture.slide[0].offsetHeight, o = i.gesture.slide.offset().left, s = i.gesture.slide.offset().top, l = o + x / 2 - a, d = s + b / 2 - r, u = i.gesture.image[0].offsetWidth, f = i.gesture.image[0].offsetHeight, h = u * i.scale, m = f * i.scale, g = Math.min(x / 2 - h / 2, 0), v = Math.min(b / 2 - m / 2, 0), y = -g, w = -v, c = l * i.scale, p = d * i.scale, c < g && (c = g), c > y && (c = y), p < v && (p = v), p > w && (p = w)) : (c = 0, p = 0), i.gesture.imageWrap.transition(300).transform("translate3d(" + c + "px, " + p + "px,0)"), i.gesture.image.transition(300).transform("translate3d(0,0,0) scale(" + i.scale + ")"))
                    }
                },
                attachEvents: function (e) {
                    var n = e ? "off" : "on";
                    if (T.params.zoom) {
                        var i = (T.slides, !("touchstart" !== T.touchEvents.start || !T.support.passiveListener || !T.params.passiveListeners) && {
                            passive: !0,
                            capture: !1
                        });
                        T.support.gestures ? (T.slides[n]("gesturestart", T.zoom.onGestureStart, i), T.slides[n]("gesturechange", T.zoom.onGestureChange, i), T.slides[n]("gestureend", T.zoom.onGestureEnd, i)) : "touchstart" === T.touchEvents.start && (T.slides[n](T.touchEvents.start, T.zoom.onGestureStart, i), T.slides[n](T.touchEvents.move, T.zoom.onGestureChange, i), T.slides[n](T.touchEvents.end, T.zoom.onGestureEnd, i)), T[n]("touchStart", T.zoom.onTouchStart), T.slides.each(function (e, i) {
                            t(i).find("." + T.params.zoomContainerClass).length > 0 && t(i)[n](T.touchEvents.move, T.zoom.onTouchMove)
                        }), T[n]("touchEnd", T.zoom.onTouchEnd), T[n]("transitionEnd", T.zoom.onTransitionEnd), T.params.zoomToggle && T.on("doubleTap", T.zoom.toggleZoom)
                    }
                },
                init: function () {
                    T.zoom.attachEvents()
                },
                destroy: function () {
                    T.zoom.attachEvents(!0)
                }
            }, T._plugins = [];
            for (var R in T.plugins) {
                var B = T.plugins[R](T, T.params[R]);
                B && T._plugins.push(B)
            }
            return T.callPlugins = function (e) {
                for (var t = 0; t < T._plugins.length; t++)e in T._plugins[t] && T._plugins[t][e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
            }, T.emitterEventListeners = {}, T.emit = function (e) {
                T.params[e] && T.params[e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
                var t;
                if (T.emitterEventListeners[e])for (t = 0; t < T.emitterEventListeners[e].length; t++)T.emitterEventListeners[e][t](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
                T.callPlugins && T.callPlugins(e, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
            }, T.on = function (e, t) {
                return e = m(e), T.emitterEventListeners[e] || (T.emitterEventListeners[e] = []), T.emitterEventListeners[e].push(t), T
            }, T.off = function (e, t) {
                var n;
                if (e = m(e), "undefined" == typeof t)return T.emitterEventListeners[e] = [], T;
                if (T.emitterEventListeners[e] && 0 !== T.emitterEventListeners[e].length) {
                    for (n = 0; n < T.emitterEventListeners[e].length; n++)T.emitterEventListeners[e][n] === t && T.emitterEventListeners[e].splice(n, 1);
                    return T
                }
            }, T.once = function (e, t) {
                e = m(e);
                var n = function () {
                    t(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]), T.off(e, n)
                };
                return T.on(e, n), T
            }, T.a11y = {
                makeFocusable: function (e) {
                    return e.attr("tabIndex", "0"), e
                },
                addRole: function (e, t) {
                    return e.attr("role", t), e
                },
                addLabel: function (e, t) {
                    return e.attr("aria-label", t), e
                },
                disable: function (e) {
                    return e.attr("aria-disabled", !0), e
                },
                enable: function (e) {
                    return e.attr("aria-disabled", !1), e
                },
                onEnterKey: function (e) {
                    13 === e.keyCode && (t(e.target).is(T.params.nextButton) ? (T.onClickNext(e), T.isEnd ? T.a11y.notify(T.params.lastSlideMessage) : T.a11y.notify(T.params.nextSlideMessage)) : t(e.target).is(T.params.prevButton) && (T.onClickPrev(e), T.isBeginning ? T.a11y.notify(T.params.firstSlideMessage) : T.a11y.notify(T.params.prevSlideMessage)), t(e.target).is("." + T.params.bulletClass) && t(e.target)[0].click())
                },
                liveRegion: t('<span class="' + T.params.notificationClass + '" aria-live="assertive" aria-atomic="true"></span>'),
                notify: function (e) {
                    var t = T.a11y.liveRegion;
                    0 !== t.length && (t.html(""), t.html(e))
                },
                init: function () {
                    T.params.nextButton && T.nextButton && T.nextButton.length > 0 && (T.a11y.makeFocusable(T.nextButton), T.a11y.addRole(T.nextButton, "button"), T.a11y.addLabel(T.nextButton, T.params.nextSlideMessage)), T.params.prevButton && T.prevButton && T.prevButton.length > 0 && (T.a11y.makeFocusable(T.prevButton), T.a11y.addRole(T.prevButton, "button"), T.a11y.addLabel(T.prevButton, T.params.prevSlideMessage)), t(T.container).append(T.a11y.liveRegion)
                },
                initPagination: function () {
                    T.params.pagination && T.params.paginationClickable && T.bullets && T.bullets.length && T.bullets.each(function () {
                        var e = t(this);
                        T.a11y.makeFocusable(e), T.a11y.addRole(e, "button"), T.a11y.addLabel(e, T.params.paginationBulletMessage.replace(/{{index}}/, e.index() + 1))
                    })
                },
                destroy: function () {
                    T.a11y.liveRegion && T.a11y.liveRegion.length > 0 && T.a11y.liveRegion.remove()
                }
            }, T.init = function () {
                T.params.loop && T.createLoop(), T.updateContainerSize(), T.updateSlidesSize(), T.updatePagination(), T.params.scrollbar && T.scrollbar && (T.scrollbar.set(), T.params.scrollbarDraggable && T.scrollbar.enableDraggable()), "slide" !== T.params.effect && T.effects[T.params.effect] && (T.params.loop || T.updateProgress(), T.effects[T.params.effect].setTranslate()), T.params.loop ? T.slideTo(T.params.initialSlide + T.loopedSlides, 0, T.params.runCallbacksOnInit) : (T.slideTo(T.params.initialSlide, 0, T.params.runCallbacksOnInit), 0 === T.params.initialSlide && (T.parallax && T.params.parallax && T.parallax.setTranslate(), T.lazy && T.params.lazyLoading && (T.lazy.load(), T.lazy.initialImageLoaded = !0))), T.attachEvents(), T.params.observer && T.support.observer && T.initObservers(), T.params.preloadImages && !T.params.lazyLoading && T.preloadImages(), T.params.zoom && T.zoom && T.zoom.init(), T.params.autoplay && T.startAutoplay(), T.params.keyboardControl && T.enableKeyboardControl && T.enableKeyboardControl(), T.params.mousewheelControl && T.enableMousewheelControl && T.enableMousewheelControl(), T.params.hashnavReplaceState && (T.params.replaceState = T.params.hashnavReplaceState), T.params.history && T.history && T.history.init(), T.params.hashnav && T.hashnav && T.hashnav.init(), T.params.a11y && T.a11y && T.a11y.init(), T.emit("onInit", T)
            }, T.cleanupStyles = function () {
                T.container.removeClass(T.classNames.join(" ")).removeAttr("style"), T.wrapper.removeAttr("style"), T.slides && T.slides.length && T.slides.removeClass([T.params.slideVisibleClass, T.params.slideActiveClass, T.params.slideNextClass, T.params.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-column").removeAttr("data-swiper-row"), T.paginationContainer && T.paginationContainer.length && T.paginationContainer.removeClass(T.params.paginationHiddenClass), T.bullets && T.bullets.length && T.bullets.removeClass(T.params.bulletActiveClass), T.params.prevButton && t(T.params.prevButton).removeClass(T.params.buttonDisabledClass), T.params.nextButton && t(T.params.nextButton).removeClass(T.params.buttonDisabledClass), T.params.scrollbar && T.scrollbar && (T.scrollbar.track && T.scrollbar.track.length && T.scrollbar.track.removeAttr("style"), T.scrollbar.drag && T.scrollbar.drag.length && T.scrollbar.drag.removeAttr("style"))
            }, T.destroy = function (e, t) {
                T.detachEvents(), T.stopAutoplay(), T.params.scrollbar && T.scrollbar && T.params.scrollbarDraggable && T.scrollbar.disableDraggable(), T.params.loop && T.destroyLoop(), t && T.cleanupStyles(), T.disconnectObservers(), T.params.zoom && T.zoom && T.zoom.destroy(), T.params.keyboardControl && T.disableKeyboardControl && T.disableKeyboardControl(), T.params.mousewheelControl && T.disableMousewheelControl && T.disableMousewheelControl(), T.params.a11y && T.a11y && T.a11y.destroy(), T.params.history && !T.params.replaceState && window.removeEventListener("popstate", T.history.setHistoryPopState), T.params.hashnav && T.hashnav && T.hashnav.destroy(), T.emit("onDestroy"), e !== !1 && (T = null)
            }, T.init(), T
        }
    };
    n.prototype = {
        isSafari: function () {
            var e = navigator.userAgent.toLowerCase();
            return e.indexOf("safari") >= 0 && e.indexOf("chrome") < 0 && e.indexOf("android") < 0
        }(),
        isUiWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(navigator.userAgent),
        isArray: function (e) {
            return "[object Array]" === Object.prototype.toString.apply(e)
        },
        browser: {
            ie: window.navigator.pointerEnabled || window.navigator.msPointerEnabled,
            ieTouch: window.navigator.msPointerEnabled && window.navigator.msMaxTouchPoints > 1 || window.navigator.pointerEnabled && window.navigator.maxTouchPoints > 1,
            lteIE9: function () {
                var e = document.createElement("div");
                return e.innerHTML = "<!--[if lte IE 9]><i></i><![endif]-->", 1 === e.getElementsByTagName("i").length
            }()
        },
        device: function () {
            var e = navigator.userAgent, t = e.match(/(Android);?[\s\/]+([\d.]+)?/), n = e.match(/(iPad).*OS\s([\d_]+)/), i = e.match(/(iPod)(.*OS\s([\d_]+))?/), a = !n && e.match(/(iPhone\sOS)\s([\d_]+)/);
            return {ios: n || a || i, android: t}
        }(),
        support: {
            touch: window.Modernizr && Modernizr.touch === !0 || function () {
                return !!("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch)
            }(), transforms3d: window.Modernizr && Modernizr.csstransforms3d === !0 || function () {
                var e = document.createElement("div").style;
                return "webkitPerspective" in e || "MozPerspective" in e || "OPerspective" in e || "MsPerspective" in e || "perspective" in e
            }(), flexbox: function () {
                for (var e = document.createElement("div").style, t = "alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "), n = 0; n < t.length; n++)if (t[n] in e)return !0
            }(), observer: function () {
                return "MutationObserver" in window || "WebkitMutationObserver" in window
            }(), passiveListener: function () {
                var e = !1;
                try {
                    var t = Object.defineProperty({}, "passive", {
                        get: function () {
                            e = !0
                        }
                    });
                    window.addEventListener("testPassiveListener", null, t)
                } catch (n) {
                }
                return e
            }(), gestures: function () {
                return "ongesturestart" in window
            }()
        },
        plugins: {}
    };
    for (var i = (function () {
        var e = function (e) {
            var t = this, n = 0;
            for (n = 0; n < e.length; n++)t[n] = e[n];
            return t.length = e.length, this
        }, t = function (t, n) {
            var i = [], a = 0;
            if (t && !n && t instanceof e)return t;
            if (t)if ("string" == typeof t) {
                var r, o, s = t.trim();
                if (s.indexOf("<") >= 0 && s.indexOf(">") >= 0) {
                    var l = "div";
                    for (0 === s.indexOf("<li") && (l = "ul"), 0 === s.indexOf("<tr") && (l = "tbody"), 0 !== s.indexOf("<td") && 0 !== s.indexOf("<th") || (l = "tr"), 0 === s.indexOf("<tbody") && (l = "table"), 0 === s.indexOf("<option") && (l = "select"), o = document.createElement(l), o.innerHTML = t, a = 0; a < o.childNodes.length; a++)i.push(o.childNodes[a])
                } else for (r = n || "#" !== t[0] || t.match(/[ .<>:~]/) ? (n || document).querySelectorAll(t) : [document.getElementById(t.split("#")[1])], a = 0; a < r.length; a++)r[a] && i.push(r[a])
            } else if (t.nodeType || t === window || t === document)i.push(t); else if (t.length > 0 && t[0].nodeType)for (a = 0; a < t.length; a++)i.push(t[a]);
            return new e(i)
        };
        return e.prototype = {
            addClass: function (e) {
                if ("undefined" == typeof e)return this;
                for (var t = e.split(" "), n = 0; n < t.length; n++)for (var i = 0; i < this.length; i++)this[i].classList.add(t[n]);
                return this
            }, removeClass: function (e) {
                for (var t = e.split(" "), n = 0; n < t.length; n++)for (var i = 0; i < this.length; i++)this[i].classList.remove(t[n]);
                return this
            }, hasClass: function (e) {
                return !!this[0] && this[0].classList.contains(e)
            }, toggleClass: function (e) {
                for (var t = e.split(" "), n = 0; n < t.length; n++)for (var i = 0; i < this.length; i++)this[i].classList.toggle(t[n]);
                return this
            }, attr: function (e, t) {
                if (1 === arguments.length && "string" == typeof e)return this[0] ? this[0].getAttribute(e) : void 0;
                for (var n = 0; n < this.length; n++)if (2 === arguments.length)this[n].setAttribute(e, t); else for (var i in e)this[n][i] = e[i], this[n].setAttribute(i, e[i]);
                return this
            }, removeAttr: function (e) {
                for (var t = 0; t < this.length; t++)this[t].removeAttribute(e);
                return this
            }, data: function (e, t) {
                if ("undefined" != typeof t) {
                    for (var n = 0; n < this.length; n++) {
                        var i = this[n];
                        i.dom7ElementDataStorage || (i.dom7ElementDataStorage = {}), i.dom7ElementDataStorage[e] = t
                    }
                    return this
                }
                if (this[0]) {
                    var a = this[0].getAttribute("data-" + e);
                    return a ? a : this[0].dom7ElementDataStorage && e in this[0].dom7ElementDataStorage ? this[0].dom7ElementDataStorage[e] : void 0
                }
            }, transform: function (e) {
                for (var t = 0; t < this.length; t++) {
                    var n = this[t].style;
                    n.webkitTransform = n.MsTransform = n.msTransform = n.MozTransform = n.OTransform = n.transform = e
                }
                return this
            }, transition: function (e) {
                "string" != typeof e && (e += "ms");
                for (var t = 0; t < this.length; t++) {
                    var n = this[t].style;
                    n.webkitTransitionDuration = n.MsTransitionDuration = n.msTransitionDuration = n.MozTransitionDuration = n.OTransitionDuration = n.transitionDuration = e
                }
                return this
            }, on: function (e, n, i, a) {
                function r(e) {
                    var a = e.target;
                    if (t(a).is(n))i.call(a, e); else for (var r = t(a).parents(), o = 0; o < r.length; o++)t(r[o]).is(n) && i.call(r[o], e)
                }

                var o, s, l = e.split(" ");
                for (o = 0; o < this.length; o++)if ("function" == typeof n || n === !1)for ("function" == typeof n && (i = arguments[1], a = arguments[2] || !1), s = 0; s < l.length; s++)this[o].addEventListener(l[s], i, a); else for (s = 0; s < l.length; s++)this[o].dom7LiveListeners || (this[o].dom7LiveListeners = []), this[o].dom7LiveListeners.push({
                    listener: i,
                    liveListener: r
                }), this[o].addEventListener(l[s], r, a);
                return this
            }, off: function (e, t, n, i) {
                for (var a = e.split(" "), r = 0; r < a.length; r++)for (var o = 0; o < this.length; o++)if ("function" == typeof t || t === !1)"function" == typeof t && (n = arguments[1], i = arguments[2] || !1), this[o].removeEventListener(a[r], n, i); else if (this[o].dom7LiveListeners)for (var s = 0; s < this[o].dom7LiveListeners.length; s++)this[o].dom7LiveListeners[s].listener === n && this[o].removeEventListener(a[r], this[o].dom7LiveListeners[s].liveListener, i);
                return this
            }, once: function (e, t, n, i) {
                function a(o) {
                    n(o), r.off(e, t, a, i)
                }

                var r = this;
                "function" == typeof t && (t = !1, n = arguments[1], i = arguments[2]), r.on(e, t, a, i)
            }, trigger: function (e, t) {
                for (var n = 0; n < this.length; n++) {
                    var i;
                    try {
                        i = new window.CustomEvent(e, {detail: t, bubbles: !0, cancelable: !0})
                    } catch (a) {
                        i = document.createEvent("Event"), i.initEvent(e, !0, !0), i.detail = t
                    }
                    this[n].dispatchEvent(i)
                }
                return this
            }, transitionEnd: function (e) {
                function t(r) {
                    if (r.target === this)for (e.call(this, r), n = 0; n < i.length; n++)a.off(i[n], t)
                }

                var n, i = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], a = this;
                if (e)for (n = 0; n < i.length; n++)a.on(i[n], t);
                return this
            }, width: function () {
                return this[0] === window ? window.innerWidth : this.length > 0 ? parseFloat(this.css("width")) : null
            }, outerWidth: function (e) {
                return this.length > 0 ? e ? this[0].offsetWidth + parseFloat(this.css("margin-right")) + parseFloat(this.css("margin-left")) : this[0].offsetWidth : null
            }, height: function () {
                return this[0] === window ? window.innerHeight : this.length > 0 ? parseFloat(this.css("height")) : null
            }, outerHeight: function (e) {
                return this.length > 0 ? e ? this[0].offsetHeight + parseFloat(this.css("margin-top")) + parseFloat(this.css("margin-bottom")) : this[0].offsetHeight : null
            }, offset: function () {
                if (this.length > 0) {
                    var e = this[0], t = e.getBoundingClientRect(), n = document.body, i = e.clientTop || n.clientTop || 0, a = e.clientLeft || n.clientLeft || 0, r = window.pageYOffset || e.scrollTop, o = window.pageXOffset || e.scrollLeft;
                    return {top: t.top + r - i, left: t.left + o - a}
                }
                return null
            }, css: function (e, t) {
                var n;
                if (1 === arguments.length) {
                    if ("string" != typeof e) {
                        for (n = 0; n < this.length; n++)for (var i in e)this[n].style[i] = e[i];
                        return this
                    }
                    if (this[0])return window.getComputedStyle(this[0], null).getPropertyValue(e)
                }
                if (2 === arguments.length && "string" == typeof e) {
                    for (n = 0; n < this.length; n++)this[n].style[e] = t;
                    return this
                }
                return this
            }, each: function (e) {
                for (var t = 0; t < this.length; t++)e.call(this[t], t, this[t]);
                return this
            }, html: function (e) {
                if ("undefined" == typeof e)return this[0] ? this[0].innerHTML : void 0;
                for (var t = 0; t < this.length; t++)this[t].innerHTML = e;
                return this
            }, text: function (e) {
                if ("undefined" == typeof e)return this[0] ? this[0].textContent.trim() : null;
                for (var t = 0; t < this.length; t++)this[t].textContent = e;
                return this
            }, is: function (n) {
                if (!this[0])return !1;
                var i, a;
                if ("string" == typeof n) {
                    var r = this[0];
                    if (r === document)return n === document;
                    if (r === window)return n === window;
                    if (r.matches)return r.matches(n);
                    if (r.webkitMatchesSelector)return r.webkitMatchesSelector(n);
                    if (r.mozMatchesSelector)return r.mozMatchesSelector(n);
                    if (r.msMatchesSelector)return r.msMatchesSelector(n);
                    for (i = t(n), a = 0; a < i.length; a++)if (i[a] === this[0])return !0;
                    return !1
                }
                if (n === document)return this[0] === document;
                if (n === window)return this[0] === window;
                if (n.nodeType || n instanceof e) {
                    for (i = n.nodeType ? [n] : n, a = 0; a < i.length; a++)if (i[a] === this[0])return !0;
                    return !1
                }
                return !1
            }, index: function () {
                if (this[0]) {
                    for (var e = this[0], t = 0; null !== (e = e.previousSibling);)1 === e.nodeType && t++;
                    return t
                }
            }, eq: function (t) {
                if ("undefined" == typeof t)return this;
                var n, i = this.length;
                return t > i - 1 ? new e([]) : t < 0 ? (n = i + t, new e(n < 0 ? [] : [this[n]])) : new e([this[t]])
            }, append: function (t) {
                var n, i;
                for (n = 0; n < this.length; n++)if ("string" == typeof t) {
                    var a = document.createElement("div");
                    for (a.innerHTML = t; a.firstChild;)this[n].appendChild(a.firstChild)
                } else if (t instanceof e)for (i = 0; i < t.length; i++)this[n].appendChild(t[i]); else this[n].appendChild(t);
                return this
            }, prepend: function (t) {
                var n, i;
                for (n = 0; n < this.length; n++)if ("string" == typeof t) {
                    var a = document.createElement("div");
                    for (a.innerHTML = t, i = a.childNodes.length - 1; i >= 0; i--)this[n].insertBefore(a.childNodes[i], this[n].childNodes[0])
                } else if (t instanceof e)for (i = 0; i < t.length; i++)this[n].insertBefore(t[i], this[n].childNodes[0]); else this[n].insertBefore(t, this[n].childNodes[0]);
                return this
            }, insertBefore: function (e) {
                for (var n = t(e), i = 0; i < this.length; i++)if (1 === n.length)n[0].parentNode.insertBefore(this[i], n[0]); else if (n.length > 1)for (var a = 0; a < n.length; a++)n[a].parentNode.insertBefore(this[i].cloneNode(!0), n[a])
            }, insertAfter: function (e) {
                for (var n = t(e), i = 0; i < this.length; i++)if (1 === n.length)n[0].parentNode.insertBefore(this[i], n[0].nextSibling); else if (n.length > 1)for (var a = 0; a < n.length; a++)n[a].parentNode.insertBefore(this[i].cloneNode(!0), n[a].nextSibling)
            }, next: function (n) {
                return new e(this.length > 0 ? n ? this[0].nextElementSibling && t(this[0].nextElementSibling).is(n) ? [this[0].nextElementSibling] : [] : this[0].nextElementSibling ? [this[0].nextElementSibling] : [] : [])
            }, nextAll: function (n) {
                var i = [], a = this[0];
                if (!a)return new e([]);
                for (; a.nextElementSibling;) {
                    var r = a.nextElementSibling;
                    n ? t(r).is(n) && i.push(r) : i.push(r), a = r
                }
                return new e(i)
            }, prev: function (n) {
                return new e(this.length > 0 ? n ? this[0].previousElementSibling && t(this[0].previousElementSibling).is(n) ? [this[0].previousElementSibling] : [] : this[0].previousElementSibling ? [this[0].previousElementSibling] : [] : [])
            }, prevAll: function (n) {
                var i = [], a = this[0];
                if (!a)return new e([]);
                for (; a.previousElementSibling;) {
                    var r = a.previousElementSibling;
                    n ? t(r).is(n) && i.push(r) : i.push(r), a = r
                }
                return new e(i)
            }, parent: function (e) {
                for (var n = [], i = 0; i < this.length; i++)e ? t(this[i].parentNode).is(e) && n.push(this[i].parentNode) : n.push(this[i].parentNode);
                return t(t.unique(n))
            }, parents: function (e) {
                for (var n = [], i = 0; i < this.length; i++)for (var a = this[i].parentNode; a;)e ? t(a).is(e) && n.push(a) : n.push(a), a = a.parentNode;
                return t(t.unique(n))
            }, find: function (t) {
                for (var n = [], i = 0; i < this.length; i++)for (var a = this[i].querySelectorAll(t), r = 0; r < a.length; r++)n.push(a[r]);
                return new e(n)
            }, children: function (n) {
                for (var i = [], a = 0; a < this.length; a++)for (var r = this[a].childNodes, o = 0; o < r.length; o++)n ? 1 === r[o].nodeType && t(r[o]).is(n) && i.push(r[o]) : 1 === r[o].nodeType && i.push(r[o]);
                return new e(t.unique(i))
            }, remove: function () {
                for (var e = 0; e < this.length; e++)this[e].parentNode && this[e].parentNode.removeChild(this[e]);
                return this
            }, add: function () {
                var e, n, i = this;
                for (e = 0; e < arguments.length; e++) {
                    var a = t(arguments[e]);
                    for (n = 0; n < a.length; n++)i[i.length] = a[n], i.length++
                }
                return i
            }
        }, t.fn = e.prototype, t.unique = function (e) {
            for (var t = [], n = 0; n < e.length; n++)t.indexOf(e[n]) === -1 && t.push(e[n]);
            return t
        }, t
    }()), a = ["jQuery", "Zepto", "Dom7"], r = 0; r < a.length; r++)window[a[r]] && e(window[a[r]]);
    var o;
    o = "undefined" == typeof i ? window.Dom7 || window.Zepto || window.jQuery : i, o && ("transitionEnd" in o.fn || (o.fn.transitionEnd = function (e) {
        function t(r) {
            if (r.target === this)for (e.call(this, r), n = 0; n < i.length; n++)a.off(i[n], t)
        }

        var n, i = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], a = this;
        if (e)for (n = 0; n < i.length; n++)a.on(i[n], t);
        return this
    }), "transform" in o.fn || (o.fn.transform = function (e) {
        for (var t = 0; t < this.length; t++) {
            var n = this[t].style;
            n.webkitTransform = n.MsTransform = n.msTransform = n.MozTransform = n.OTransform = n.transform = e
        }
        return this
    }), "transition" in o.fn || (o.fn.transition = function (e) {
        "string" != typeof e && (e += "ms");
        for (var t = 0; t < this.length; t++) {
            var n = this[t].style;
            n.webkitTransitionDuration = n.MsTransitionDuration = n.msTransitionDuration = n.MozTransitionDuration = n.OTransitionDuration = n.transitionDuration = e
        }
        return this
    }), "outerWidth" in o.fn || (o.fn.outerWidth = function (e) {
        return this.length > 0 ? e ? this[0].offsetWidth + parseFloat(this.css("margin-right")) + parseFloat(this.css("margin-left")) : this[0].offsetWidth : null
    })), window.Swiper = n
}(), "undefined" != typeof module ? module.exports = window.Swiper : "function" == typeof define && define.amd && define([], function () {
    "use strict";
    return window.Swiper
}), function (e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : "undefined" != typeof module && module.exports ? module.exports = e(require("jquery")) : e(jQuery)
}(function (e) {
    var t = -1, n = -1, i = function (e) {
        return parseFloat(e) || 0
    }, a = function (t) {
        var n = 1, a = e(t), r = null, o = [];
        return a.each(function () {
            var t = e(this), a = t.offset().top - i(t.css("margin-top")), s = o.length > 0 ? o[o.length - 1] : null;
            null === s ? o.push(t) : Math.floor(Math.abs(r - a)) <= n ? o[o.length - 1] = s.add(t) : o.push(t), r = a
        }), o
    }, r = function (t) {
        var n = {byRow: !0, property: "height", target: null, remove: !1};
        return "object" == typeof t ? e.extend(n, t) : ("boolean" == typeof t ? n.byRow = t : "remove" === t && (n.remove = !0), n)
    }, o = e.fn.matchHeight = function (t) {
        var n = r(t);
        if (n.remove) {
            var i = this;
            return this.css(n.property, ""), e.each(o._groups, function (e, t) {
                t.elements = t.elements.not(i)
            }), this
        }
        return this.length <= 1 && !n.target ? this : (o._groups.push({
            elements: this,
            options: n
        }), o._apply(this, n), this)
    };
    o.version = "0.7.0", o._groups = [], o._throttle = 80, o._maintainScroll = !1, o._beforeUpdate = null, o._afterUpdate = null, o._rows = a, o._parse = i, o._parseOptions = r, o._apply = function (t, n) {
        var s = r(n), l = e(t), d = [l], c = e(window).scrollTop(), p = e("html").outerHeight(!0), u = l.parents().filter(":hidden");
        return u.each(function () {
            var t = e(this);
            t.data("style-cache", t.attr("style"))
        }), u.css("display", "block"), s.byRow && !s.target && (l.each(function () {
            var t = e(this), n = t.css("display");
            "inline-block" !== n && "flex" !== n && "inline-flex" !== n && (n = "block"), t.data("style-cache", t.attr("style")), t.css({
                display: n,
                "padding-top": "0",
                "padding-bottom": "0",
                "margin-top": "0",
                "margin-bottom": "0",
                "border-top-width": "0",
                "border-bottom-width": "0",
                height: "100px",
                overflow: "hidden"
            })
        }), d = a(l), l.each(function () {
            var t = e(this);
            t.attr("style", t.data("style-cache") || "")
        })), e.each(d, function (t, n) {
            var a = e(n), r = 0;
            if (s.target)r = s.target.outerHeight(!1); else {
                if (s.byRow && a.length <= 1)return void a.css(s.property, "");
                a.each(function () {
                    var t = e(this), n = t.attr("style"), i = t.css("display");
                    "inline-block" !== i && "flex" !== i && "inline-flex" !== i && (i = "block");
                    var a = {display: i};
                    a[s.property] = "", t.css(a), t.outerHeight(!1) > r && (r = t.outerHeight(!1)), n ? t.attr("style", n) : t.css("display", "")
                })
            }
            a.each(function () {
                var t = e(this), n = 0;
                s.target && t.is(s.target) || ("border-box" !== t.css("box-sizing") && (n += i(t.css("border-top-width")) + i(t.css("border-bottom-width")), n += i(t.css("padding-top")) + i(t.css("padding-bottom"))), t.css(s.property, r - n + "px"))
            })
        }), u.each(function () {
            var t = e(this);
            t.attr("style", t.data("style-cache") || null)
        }), o._maintainScroll && e(window).scrollTop(c / p * e("html").outerHeight(!0)), this
    }, o._applyDataApi = function () {
        var t = {};
        e("[data-match-height], [data-mh]").each(function () {
            var n = e(this), i = n.attr("data-mh") || n.attr("data-match-height");
            i in t ? t[i] = t[i].add(n) : t[i] = n
        }), e.each(t, function () {
            this.matchHeight(!0)
        })
    };
    var s = function (t) {
        o._beforeUpdate && o._beforeUpdate(t, o._groups), e.each(o._groups, function () {
            o._apply(this.elements, this.options)
        }), o._afterUpdate && o._afterUpdate(t, o._groups)
    };
    o._update = function (i, a) {
        if (a && "resize" === a.type) {
            var r = e(window).width();
            if (r === t)return;
            t = r
        }
        i ? n === -1 && (n = setTimeout(function () {
            s(a), n = -1
        }, o._throttle)) : s(a)
    }, e(o._applyDataApi), e(window).bind("load", function (e) {
        o._update(!1, e)
    }), e(window).bind("resize orientationchange", function (e) {
        o._update(!0, e)
    })
}), function (e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e : e(jQuery)
}(function (e) {
    function t(t) {
        var o = t || window.event, s = l.call(arguments, 1), d = 0, p = 0, u = 0, f = 0, h = 0, m = 0;
        if (t = e.event.fix(o), t.type = "mousewheel", "detail" in o && (u = o.detail * -1), "wheelDelta" in o && (u = o.wheelDelta), "wheelDeltaY" in o && (u = o.wheelDeltaY), "wheelDeltaX" in o && (p = o.wheelDeltaX * -1), "axis" in o && o.axis === o.HORIZONTAL_AXIS && (p = u * -1, u = 0), d = 0 === u ? p : u, "deltaY" in o && (u = o.deltaY * -1, d = u), "deltaX" in o && (p = o.deltaX, 0 === u && (d = p * -1)), 0 !== u || 0 !== p) {
            if (1 === o.deltaMode) {
                var g = e.data(this, "mousewheel-line-height");
                d *= g, u *= g, p *= g
            } else if (2 === o.deltaMode) {
                var v = e.data(this, "mousewheel-page-height");
                d *= v, u *= v, p *= v
            }
            if (f = Math.max(Math.abs(u), Math.abs(p)), (!r || f < r) && (r = f, i(o, f) && (r /= 40)), i(o, f) && (d /= 40, p /= 40, u /= 40), d = Math[d >= 1 ? "floor" : "ceil"](d / r), p = Math[p >= 1 ? "floor" : "ceil"](p / r), u = Math[u >= 1 ? "floor" : "ceil"](u / r), c.settings.normalizeOffset && this.getBoundingClientRect) {
                var y = this.getBoundingClientRect();
                h = t.clientX - y.left, m = t.clientY - y.top
            }
            return t.deltaX = p, t.deltaY = u, t.deltaFactor = r, t.offsetX = h, t.offsetY = m, t.deltaMode = 0, s.unshift(t, d, p, u), a && clearTimeout(a), a = setTimeout(n, 200), (e.event.dispatch || e.event.handle).apply(this, s)
        }
    }

    function n() {
        r = null
    }

    function i(e, t) {
        return c.settings.adjustOldDeltas && "mousewheel" === e.type && t % 120 === 0
    }

    var a, r, o = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"], s = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"], l = Array.prototype.slice;
    if (e.event.fixHooks)for (var d = o.length; d;)e.event.fixHooks[o[--d]] = e.event.mouseHooks;
    var c = e.event.special.mousewheel = {
        version: "3.1.12", setup: function () {
            if (this.addEventListener)for (var n = s.length; n;)this.addEventListener(s[--n], t, !1); else this.onmousewheel = t;
            e.data(this, "mousewheel-line-height", c.getLineHeight(this)), e.data(this, "mousewheel-page-height", c.getPageHeight(this))
        }, teardown: function () {
            if (this.removeEventListener)for (var n = s.length; n;)this.removeEventListener(s[--n], t, !1); else this.onmousewheel = null;
            e.removeData(this, "mousewheel-line-height"), e.removeData(this, "mousewheel-page-height")
        }, getLineHeight: function (t) {
            var n = e(t), i = n["offsetParent" in e.fn ? "offsetParent" : "parent"]();
            return i.length || (i = e("body")), parseInt(i.css("fontSize"), 10) || parseInt(n.css("fontSize"), 10) || 16
        }, getPageHeight: function (t) {
            return e(t).height()
        }, settings: {adjustOldDeltas: !0, normalizeOffset: !0}
    };
    e.fn.extend({
        mousewheel: function (e) {
            return e ? this.bind("mousewheel", e) : this.trigger("mousewheel")
        }, unmousewheel: function (e) {
            return this.unbind("mousewheel", e)
        }
    })
}), !function (e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e(require("jquery")) : e(jQuery)
}(function (e) {
    "use strict";
    function t(t, n) {
        this.element = t, this.options = e.extend({}, a, n), this.init()
    }

    function n(t) {
        if (!e(t.target).parents().hasClass("jq-selectbox") && "OPTION" != t.target.nodeName && e("div.jq-selectbox.opened").length) {
            var n = e("div.jq-selectbox.opened"), a = e("div.jq-selectbox__search input", n), r = e("div.jq-selectbox__dropdown", n), o = n.find("select").data("_" + i).options;
            o.onSelectClosed.call(n), a.length && a.val("").keyup(), r.hide().find("li.sel").addClass("selected"), n.removeClass("focused opened dropup dropdown")
        }
    }

    var i = "styler", a = {
        idSuffix: "-styler",
        filePlaceholder: "Файл не выбран",
        fileBrowse: "Обзор...",
        fileNumber: "Выбрано файлов: %s",
        selectPlaceholder: "Выберите...",
        selectSearch: !1,
        selectSearchLimit: 10,
        selectSearchNotFound: "Совпадений не найдено",
        selectSearchPlaceholder: "Поиск...",
        selectVisibleOptions: 0,
        singleSelectzIndex: "100",
        selectSmartPositioning: !0,
        onSelectOpened: function () {
        },
        onSelectClosed: function () {
        },
        onFormStyled: function () {
        }
    };
    t.prototype = {
        init: function () {
            function t() {
                void 0 !== i.attr("id") && "" !== i.attr("id") && (this.id = i.attr("id") + a.idSuffix), this.title = i.attr("title"), this.classes = i.attr("class"), this.data = i.data()
            }

            var i = e(this.element), a = this.options, r = !(!navigator.userAgent.match(/(iPad|iPhone|iPod)/i) || navigator.userAgent.match(/(Windows\sPhone)/i)), o = !(!navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/(Windows\sPhone)/i));
            if (i.is(":checkbox")) {
                var s = function () {
                    var n = new t, a = e('<div class="jq-checkbox"><div class="jq-checkbox__div"></div></div>').attr({
                        id: n.id,
                        title: n.title
                    }).addClass(n.classes).data(n.data);
                    i.css({
                        position: "absolute",
                        zIndex: "-1",
                        opacity: 0,
                        margin: 0,
                        padding: 0
                    }).after(a).prependTo(a), a.attr("unselectable", "on").css({
                        "-webkit-user-select": "none",
                        "-moz-user-select": "none",
                        "-ms-user-select": "none",
                        "-o-user-select": "none",
                        "user-select": "none",
                        display: "inline-block",
                        position: "relative",
                        overflow: "hidden"
                    }), i.is(":checked") && a.addClass("checked"), i.is(":disabled") && a.addClass("disabled"), a.click(function (e) {
                        e.preventDefault(), a.is(".disabled") || (i.is(":checked") ? (i.prop("checked", !1), a.removeClass("checked")) : (i.prop("checked", !0), a.addClass("checked")), i.focus().change())
                    }), i.closest("label").add('label[for="' + i.attr("id") + '"]').on("click.styler", function (t) {
                        e(t.target).is("a") || e(t.target).closest(a).length || (a.triggerHandler("click"), t.preventDefault())
                    }), i.on("change.styler", function () {
                        i.is(":checked") ? a.addClass("checked") : a.removeClass("checked")
                    }).on("keydown.styler", function (e) {
                        32 == e.which && a.click()
                    }).on("focus.styler", function () {
                        a.is(".disabled") || a.addClass("focused")
                    }).on("blur.styler", function () {
                        a.removeClass("focused")
                    })
                };
                s(), i.on("refresh", function () {
                    i.closest("label").add('label[for="' + i.attr("id") + '"]').off(".styler"), i.off(".styler").parent().before(i).remove(), s()
                })
            } else if (i.is(":radio")) {
                var l = function () {
                    var n = new t, a = e('<div class="jq-radio"><div class="jq-radio__div"></div></div>').attr({
                        id: n.id,
                        title: n.title
                    }).addClass(n.classes).data(n.data);
                    i.css({
                        position: "absolute",
                        zIndex: "-1",
                        opacity: 0,
                        margin: 0,
                        padding: 0
                    }).after(a).prependTo(a), a.attr("unselectable", "on").css({
                        "-webkit-user-select": "none",
                        "-moz-user-select": "none",
                        "-ms-user-select": "none",
                        "-o-user-select": "none",
                        "user-select": "none",
                        display: "inline-block",
                        position: "relative"
                    }), i.is(":checked") && a.addClass("checked"), i.is(":disabled") && a.addClass("disabled"), e.fn.commonParents = function () {
                        var t = this;
                        return t.first().parents().filter(function () {
                            return e(this).find(t).length === t.length
                        })
                    }, e.fn.commonParent = function () {
                        return e(this).commonParents().first()
                    }, a.click(function (t) {
                        if (t.preventDefault(), !a.is(".disabled")) {
                            var n = e('input[name="' + i.attr("name") + '"]');
                            n.commonParent().find(n).prop("checked", !1).parent().removeClass("checked"), i.prop("checked", !0).parent().addClass("checked"), i.focus().change()
                        }
                    }), i.closest("label").add('label[for="' + i.attr("id") + '"]').on("click.styler", function (t) {
                        e(t.target).is("a") || e(t.target).closest(a).length || (a.triggerHandler("click"), t.preventDefault())
                    }), i.on("change.styler", function () {
                        i.parent().addClass("checked")
                    }).on("focus.styler", function () {
                        a.is(".disabled") || a.addClass("focused")
                    }).on("blur.styler", function () {
                        a.removeClass("focused")
                    })
                };
                l(), i.on("refresh", function () {
                    i.closest("label").add('label[for="' + i.attr("id") + '"]').off(".styler"), i.off(".styler").parent().before(i).remove(), l()
                })
            } else if (i.is(":file")) {
                i.css({position: "absolute", top: 0, right: 0, margin: 0, padding: 0, opacity: 0, fontSize: "100px"});
                var d = function () {
                    var n = new t, r = i.data("placeholder");
                    void 0 === r && (r = a.filePlaceholder);
                    var o = i.data("browse");
                    void 0 !== o && "" !== o || (o = a.fileBrowse);
                    var s = e('<div class="jq-file"><div class="jq-file__name">' + r + '</div><div class="jq-file__browse">' + o + "</div></div>").css({
                        display: "inline-block",
                        position: "relative",
                        overflow: "hidden"
                    }).attr({id: n.id, title: n.title}).addClass(n.classes).data(n.data);
                    i.after(s).appendTo(s), i.is(":disabled") && s.addClass("disabled"), i.on("change.styler", function () {
                        var t = i.val(), n = e("div.jq-file__name", s);
                        if (i.is("[multiple]")) {
                            t = "";
                            var o = i[0].files.length;
                            if (o > 0) {
                                var l = i.data("number");
                                void 0 === l && (l = a.fileNumber), l = l.replace("%s", o), t = l
                            }
                        }
                        n.text(t.replace(/.+[\\\/]/, "")), "" === t ? (n.text(r), s.removeClass("changed")) : s.addClass("changed")
                    }).on("focus.styler", function () {
                        s.addClass("focused")
                    }).on("blur.styler", function () {
                        s.removeClass("focused")
                    }).on("click.styler", function () {
                        s.removeClass("focused")
                    })
                };
                d(), i.on("refresh", function () {
                    i.off(".styler").parent().before(i).remove(), d()
                })
            } else if (i.is('input[type="number"]')) {
                var c = function () {
                    var n = new t, a = e('<div class="jq-number"><div class="jq-number__spin minus"></div><div class="jq-number__spin plus"></div></div>').attr({
                        id: n.id,
                        title: n.title
                    }).addClass(n.classes).data(n.data);
                    i.after(a).prependTo(a).wrap('<div class="jq-number__field"></div>'), i.is(":disabled") && a.addClass("disabled");
                    var r, o, s, l = null, d = null;
                    void 0 !== i.attr("min") && (r = i.attr("min")), void 0 !== i.attr("max") && (o = i.attr("max")), s = void 0 !== i.attr("step") && e.isNumeric(i.attr("step")) ? Number(i.attr("step")) : Number(1);
                    var c = function (t) {
                        var n, a = i.val();
                        e.isNumeric(a) || (a = 0, i.val("0")), t.is(".minus") ? n = Number(a) - s : t.is(".plus") && (n = Number(a) + s);
                        var l = (s.toString().split(".")[1] || []).length;
                        if (l > 0) {
                            for (var d = "1"; d.length <= l;)d += "0";
                            n = Math.round(n * d) / d
                        }
                        e.isNumeric(r) && e.isNumeric(o) ? n >= r && o >= n && i.val(n) : e.isNumeric(r) && !e.isNumeric(o) ? n >= r && i.val(n) : !e.isNumeric(r) && e.isNumeric(o) ? o >= n && i.val(n) : i.val(n)
                    };
                    a.is(".disabled") || (a.on("mousedown", "div.jq-number__spin", function () {
                        var t = e(this);
                        c(t), l = setTimeout(function () {
                            d = setInterval(function () {
                                c(t)
                            }, 40)
                        }, 350)
                    }).on("mouseup mouseout", "div.jq-number__spin", function () {
                        clearTimeout(l), clearInterval(d)
                    }).on("mouseup", "div.jq-number__spin", function () {
                        i.change()
                    }), i.on("focus.styler", function () {
                        a.addClass("focused")
                    }).on("blur.styler", function () {
                        a.removeClass("focused")
                    }))
                };
                c(), i.on("refresh", function () {
                    i.off(".styler").closest(".jq-number").before(i).remove(), c()
                })
            } else if (i.is("select")) {
                var p = function () {
                    function s(t) {
                        t.off("mousewheel DOMMouseScroll").on("mousewheel DOMMouseScroll", function (t) {
                            var n = null;
                            "mousewheel" == t.type ? n = -1 * t.originalEvent.wheelDelta : "DOMMouseScroll" == t.type && (n = 40 * t.originalEvent.detail), n && (t.stopPropagation(), t.preventDefault(), e(this).scrollTop(n + e(this).scrollTop()))
                        })
                    }

                    function l() {
                        for (var e = 0; e < p.length; e++) {
                            var t = p.eq(e), n = "", i = "", r = "", o = "", s = "", l = "", d = "", c = "", f = "", h = "disabled", m = "selected sel disabled";
                            t.prop("selected") && (i = "selected sel"), t.is(":disabled") && (i = h), t.is(":selected:disabled") && (i = m), void 0 !== t.attr("id") && "" !== t.attr("id") && (o = ' id="' + t.attr("id") + a.idSuffix + '"'), void 0 !== t.attr("title") && "" !== p.attr("title") && (s = ' title="' + t.attr("title") + '"'), void 0 !== t.attr("class") && (d = " " + t.attr("class"), f = ' data-jqfs-class="' + t.attr("class") + '"');
                            var g = t.data();
                            for (var v in g)"" !== g[v] && (l += " data-" + v + '="' + g[v] + '"');
                            i + d !== "" && (r = ' class="' + i + d + '"'), n = "<li" + f + l + r + s + o + ">" + t.html() + "</li>", t.parent().is("optgroup") && (void 0 !== t.parent().attr("class") && (c = " " + t.parent().attr("class")), n = "<li" + f + l + ' class="' + i + d + " option" + c + '"' + s + o + ">" + t.html() + "</li>", t.is(":first-child") && (n = '<li class="optgroup' + c + '">' + t.parent().attr("label") + "</li>" + n)), u += n
                        }
                    }

                    function d() {
                        var o = new t, d = "", c = i.data("placeholder"), f = i.data("search"), h = i.data("search-limit"), m = i.data("search-not-found"), g = i.data("search-placeholder"), v = i.data("z-index"), y = i.data("smart-positioning");
                        void 0 === c && (c = a.selectPlaceholder), void 0 !== f && "" !== f || (f = a.selectSearch), void 0 !== h && "" !== h || (h = a.selectSearchLimit), void 0 !== m && "" !== m || (m = a.selectSearchNotFound), void 0 === g && (g = a.selectSearchPlaceholder), void 0 !== v && "" !== v || (v = a.singleSelectzIndex), void 0 !== y && "" !== y || (y = a.selectSmartPositioning);
                        var w = e('<div class="jq-selectbox jqselect"><div class="jq-selectbox__select" style="position: relative"><div class="jq-selectbox__select-text"></div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div></div>').css({
                            display: "inline-block",
                            position: "relative",
                            zIndex: v
                        }).attr({id: o.id, title: o.title}).addClass(o.classes).data(o.data);
                        i.css({margin: 0, padding: 0}).after(w).prependTo(w);
                        var x = e("div.jq-selectbox__select", w), b = e("div.jq-selectbox__select-text", w), C = p.filter(":selected");
                        l(), f && (d = '<div class="jq-selectbox__search"><input type="search" autocomplete="off" placeholder="' + g + '"></div><div class="jq-selectbox__not-found">' + m + "</div>");
                        var T = e('<div class="jq-selectbox__dropdown" style="position: absolute">' + d + '<ul style="position: relative; list-style: none; overflow: auto; overflow-x: hidden">' + u + "</ul></div>");
                        w.append(T);
                        var S = e("ul", T), k = e("li", T), E = e("input", T), M = e("div.jq-selectbox__not-found", T).hide();
                        k.length < h && E.parent().hide(), "" === p.first().text() && p.first().is(":selected") ? b.text(c).addClass("placeholder") : b.text(C.text());
                        var z = 0, P = 0;
                        if (k.css({display: "inline-block"}), k.each(function () {
                                var t = e(this);
                                t.innerWidth() > z && (z = t.innerWidth(), P = t.width())
                            }), k.css({display: ""}), b.is(".placeholder") && b.width() > z)b.width(b.width()); else {
                            var D = w.clone().appendTo("body").width("auto"), L = D.outerWidth();
                            D.remove(), L == w.outerWidth() && b.width(P)
                        }
                        z > w.width() && T.width(z), "" === p.first().text() && "" !== i.data("placeholder") && k.first().hide(), i.css({
                            position: "absolute",
                            left: 0,
                            top: 0,
                            width: "100%",
                            height: "100%",
                            opacity: 0
                        });
                        var A = w.outerHeight(!0), H = E.parent().outerHeight(!0), I = S.css("max-height"), j = k.filter(".selected");
                        j.length < 1 && k.first().addClass("selected sel"), void 0 === k.data("li-height") && k.data("li-height", k.outerHeight());
                        var N = T.css("top");
                        if ("auto" == T.css("left") && T.css({left: 0}), "auto" == T.css("top") && (T.css({top: A}), N = A), T.hide(), j.length && (p.first().text() != C.text() && w.addClass("changed"), w.data("jqfs-class", j.data("jqfs-class")), w.addClass(j.data("jqfs-class"))), i.is(":disabled"))return w.addClass("disabled"), !1;
                        x.click(function () {
                            if (e("div.jq-selectbox").filter(".opened").length && a.onSelectClosed.call(e("div.jq-selectbox").filter(".opened")), i.focus(), !r) {
                                var t = e(window), n = k.data("li-height"), o = w.offset().top, l = t.height() - A - (o - t.scrollTop()), d = i.data("visible-options");
                                void 0 !== d && "" !== d || (d = a.selectVisibleOptions);
                                var c = 5 * n, u = n * d;
                                d > 0 && 6 > d && (c = u), 0 === d && (u = "auto");
                                var f = function () {
                                    T.height("auto").css({bottom: "auto", top: N});
                                    var e = function () {
                                        S.css("max-height", Math.floor((l - 20 - H) / n) * n)
                                    };
                                    e(), S.css("max-height", u), "none" != I && S.css("max-height", I), l < T.outerHeight() + 20 && e()
                                }, h = function () {
                                    T.height("auto").css({top: "auto", bottom: N});
                                    var e = function () {
                                        S.css("max-height", Math.floor((o - t.scrollTop() - 20 - H) / n) * n)
                                    };
                                    e(), S.css("max-height", u), "none" != I && S.css("max-height", I), o - t.scrollTop() - 20 < T.outerHeight() + 20 && e()
                                };
                                y === !0 || 1 === y ? l > c + H + 20 ? (f(), w.removeClass("dropup").addClass("dropdown")) : (h(), w.removeClass("dropdown").addClass("dropup")) : y !== !1 && 0 !== y || l > c + H + 20 && (f(), w.removeClass("dropup").addClass("dropdown")), w.offset().left + T.outerWidth() > t.width() && T.css({
                                    left: "auto",
                                    right: 0
                                }), e("div.jqselect").css({zIndex: v - 1}).removeClass("opened"), w.css({zIndex: v}), T.is(":hidden") ? (e("div.jq-selectbox__dropdown:visible").hide(), T.show(), w.addClass("opened focused"), a.onSelectOpened.call(w)) : (T.hide(), w.removeClass("opened dropup dropdown"), e("div.jq-selectbox").filter(".opened").length && a.onSelectClosed.call(w)), E.length && (E.val("").keyup(), M.hide(), E.keyup(function () {
                                    var t = e(this).val();
                                    k.each(function () {
                                        e(this).html().match(new RegExp(".*?" + t + ".*?", "i")) ? e(this).show() : e(this).hide()
                                    }), "" === p.first().text() && "" !== i.data("placeholder") && k.first().hide(), k.filter(":visible").length < 1 ? M.show() : M.hide()
                                })), k.filter(".selected").length && ("" === i.val() ? S.scrollTop(0) : (S.innerHeight() / n % 2 !== 0 && (n /= 2), S.scrollTop(S.scrollTop() + k.filter(".selected").position().top - S.innerHeight() / 2 + n))), s(S)
                            }
                        }), k.hover(function () {
                            e(this).siblings().removeClass("selected")
                        });
                        var O = k.filter(".selected").text();
                        k.filter(":not(.disabled):not(.optgroup)").click(function () {
                            i.focus();
                            var t = e(this), n = t.text();
                            if (!t.is(".selected")) {
                                var r = t.index();
                                r -= t.prevAll(".optgroup").length, t.addClass("selected sel").siblings().removeClass("selected sel"), p.prop("selected", !1).eq(r).prop("selected", !0), O = n, b.text(n), w.data("jqfs-class") && w.removeClass(w.data("jqfs-class")), w.data("jqfs-class", t.data("jqfs-class")), w.addClass(t.data("jqfs-class")), i.change()
                            }
                            T.hide(), w.removeClass("opened dropup dropdown"), a.onSelectClosed.call(w)
                        }), T.mouseout(function () {
                            e("li.sel", T).addClass("selected")
                        }), i.on("change.styler", function () {
                            b.text(p.filter(":selected").text()).removeClass("placeholder"), k.removeClass("selected sel").not(".optgroup").eq(i[0].selectedIndex).addClass("selected sel"), p.first().text() != k.filter(".selected").text() ? w.addClass("changed") : w.removeClass("changed")
                        }).on("focus.styler", function () {
                            w.addClass("focused"), e("div.jqselect").not(".focused").removeClass("opened dropup dropdown").find("div.jq-selectbox__dropdown").hide()
                        }).on("blur.styler", function () {
                            w.removeClass("focused")
                        }).on("keydown.styler keyup.styler", function (e) {
                            var t = k.data("li-height");
                            "" === i.val() ? b.text(c).addClass("placeholder") : b.text(p.filter(":selected").text()), k.removeClass("selected sel").not(".optgroup").eq(i[0].selectedIndex).addClass("selected sel"), 38 != e.which && 37 != e.which && 33 != e.which && 36 != e.which || ("" === i.val() ? S.scrollTop(0) : S.scrollTop(S.scrollTop() + k.filter(".selected").position().top)), 40 != e.which && 39 != e.which && 34 != e.which && 35 != e.which || S.scrollTop(S.scrollTop() + k.filter(".selected").position().top - S.innerHeight() + t), 13 == e.which && (e.preventDefault(), T.hide(), w.removeClass("opened dropup dropdown"), a.onSelectClosed.call(w))
                        }).on("keydown.styler", function (e) {
                            32 == e.which && (e.preventDefault(), x.click())
                        }), n.registered || (e(document).on("click", n), n.registered = !0)
                    }

                    function c() {
                        var n = new t, a = e('<div class="jq-select-multiple jqselect"></div>').css({
                            display: "inline-block",
                            position: "relative"
                        }).attr({id: n.id, title: n.title}).addClass(n.classes).data(n.data);
                        i.css({margin: 0, padding: 0}).after(a), l(), a.append("<ul>" + u + "</ul>");
                        var r = e("ul", a).css({
                            position: "relative",
                            "overflow-x": "hidden",
                            "-webkit-overflow-scrolling": "touch"
                        }), o = e("li", a).attr("unselectable", "on"), d = i.attr("size"), c = r.outerHeight(), f = o.outerHeight();
                        void 0 !== d && d > 0 ? r.css({height: f * d}) : r.css({height: 4 * f}), c > a.height() && (r.css("overflowY", "scroll"), s(r), o.filter(".selected").length && r.scrollTop(r.scrollTop() + o.filter(".selected").position().top)), i.prependTo(a).css({
                            position: "absolute",
                            left: 0,
                            top: 0,
                            width: "100%",
                            height: "100%",
                            opacity: 0
                        }), i.is(":disabled") ? (a.addClass("disabled"), p.each(function () {
                            e(this).is(":selected") && o.eq(e(this).index()).addClass("selected")
                        })) : (o.filter(":not(.disabled):not(.optgroup)").click(function (t) {
                            i.focus();
                            var n = e(this);
                            if (t.ctrlKey || t.metaKey || n.addClass("selected"), t.shiftKey || n.addClass("first"), t.ctrlKey || t.metaKey || t.shiftKey || n.siblings().removeClass("selected first"), (t.ctrlKey || t.metaKey) && (n.is(".selected") ? n.removeClass("selected first") : n.addClass("selected first"), n.siblings().removeClass("first")), t.shiftKey) {
                                var a = !1, r = !1;
                                n.siblings().removeClass("selected").siblings(".first").addClass("selected"), n.prevAll().each(function () {
                                    e(this).is(".first") && (a = !0)
                                }), n.nextAll().each(function () {
                                    e(this).is(".first") && (r = !0)
                                }), a && n.prevAll().each(function () {
                                    return !e(this).is(".selected") && void e(this).not(".disabled, .optgroup").addClass("selected")
                                }), r && n.nextAll().each(function () {
                                    return !e(this).is(".selected") && void e(this).not(".disabled, .optgroup").addClass("selected")
                                }), 1 == o.filter(".selected").length && n.addClass("first")
                            }
                            p.prop("selected", !1), o.filter(".selected").each(function () {
                                var t = e(this), n = t.index();
                                t.is(".option") && (n -= t.prevAll(".optgroup").length), p.eq(n).prop("selected", !0)
                            }), i.change()
                        }), p.each(function (t) {
                            e(this).data("optionIndex", t)
                        }), i.on("change.styler", function () {
                            o.removeClass("selected");
                            var t = [];
                            p.filter(":selected").each(function () {
                                t.push(e(this).data("optionIndex"))
                            }), o.not(".optgroup").filter(function (n) {
                                return e.inArray(n, t) > -1
                            }).addClass("selected")
                        }).on("focus.styler", function () {
                            a.addClass("focused")
                        }).on("blur.styler", function () {
                            a.removeClass("focused")
                        }), c > a.height() && i.on("keydown.styler", function (e) {
                            38 != e.which && 37 != e.which && 33 != e.which || r.scrollTop(r.scrollTop() + o.filter(".selected").position().top - f), 40 != e.which && 39 != e.which && 34 != e.which || r.scrollTop(r.scrollTop() + o.filter(".selected:last").position().top - r.innerHeight() + 2 * f)
                        }))
                    }

                    var p = e("option", i), u = "";
                    if (i.is("[multiple]")) {
                        if (o || r)return;
                        c()
                    } else d()
                };
                p(), i.on("refresh", function () {
                    i.off(".styler").parent().before(i).remove(), p()
                })
            } else i.is(":reset") && i.on("click", function () {
                setTimeout(function () {
                    i.closest("form").find("input, select").trigger("refresh")
                }, 1)
            })
        }, destroy: function () {
            var t = e(this.element);
            t.is(":checkbox") || t.is(":radio") ? (t.removeData("_" + i).off(".styler refresh").removeAttr("style").parent().before(t).remove(), t.closest("label").add('label[for="' + t.attr("id") + '"]').off(".styler")) : t.is('input[type="number"]') ? t.removeData("_" + i).off(".styler refresh").closest(".jq-number").before(t).remove() : (t.is(":file") || t.is("select")) && t.removeData("_" + i).off(".styler refresh").removeAttr("style").parent().before(t).remove()
        }
    }, e.fn[i] = function (n) {
        var a = arguments;
        if (void 0 === n || "object" == typeof n)return this.each(function () {
            e.data(this, "_" + i) || e.data(this, "_" + i, new t(this, n))
        }).promise().done(function () {
            var t = e(this[0]).data("_" + i);
            t && t.options.onFormStyled.call()
        }), this;
        if ("string" == typeof n && "_" !== n[0] && "init" !== n) {
            var r;
            return this.each(function () {
                var o = e.data(this, "_" + i);
                o instanceof t && "function" == typeof o[n] && (r = o[n].apply(o, Array.prototype.slice.call(a, 1)))
            }), void 0 !== r ? r : this
        }
    }, n.registered = !1
}), function (e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : e(jQuery)
}(function (e) {
    function t() {
        e(window).width() === a && e(window).height() === r || (e(o).each(function () {
            e(this).flexMenu({undo: !0}).flexMenu(this.options)
        }), a = e(window).width(), r = e(window).height())
    }

    function n(t) {
        var n, i;
        n = e("li.flexMenu-viewMore.active"), i = n.not(t), i.removeClass("active").find("> ul").hide()
    }

    var i, a = e(window).width(), r = e(window).height(), o = [];
    e(window).resize(function () {
        clearTimeout(i), i = setTimeout(function () {
            t()
        }, 200)
    }), e.fn.flexMenu = function (t) {
        var i, a = e.extend({
            threshold: 2,
            cutoff: 2,
            linkText: "More",
            linkTitle: "View More",
            linkTextAll: "Menu",
            linkTitleAll: "Open/Close Menu",
            showOnHover: !0,
            popupAbsolute: !0,
            popupClass: "",
            undo: !1
        }, t);
        return this.options = a, i = e.inArray(this, o), i >= 0 ? o.splice(i, 1) : o.push(this), this.each(function () {
            function t(e) {
                var t = Math.ceil(e.offset().top) >= g + v;
                return t
            }

            var i, r, o, s, l, d, c, p = e(this), u = p.find("> li"), f = u.first(), h = u.last(), m = p.find("li").length, g = Math.floor(f.offset().top), v = Math.floor(f.outerHeight(!0)), y = !1;
            if (t(h) && m > a.threshold && !a.undo && p.is(":visible")) {
                var w = e('<ul class="flexMenu-popup" style="display:none;' + (a.popupAbsolute ? " position: absolute;" : "") + '"></ul>');
                for (w.addClass(a.popupClass), c = m; c > 1; c--) {
                    if (i = p.find("> li:last-child"), r = t(i), c - 1 <= a.cutoff) {
                        e(p.children().get().reverse()).appendTo(w), y = !0;
                        break
                    }
                    if (!r)break;
                    i.appendTo(w)
                }
                y ? p.append('<li class="flexMenu-viewMore flexMenu-allInPopup"><a href="#" title="' + a.linkTitleAll + '">' + a.linkTextAll + "</a></li>") : p.append('<li class="flexMenu-viewMore"><a href="#" title="' + a.linkTitle + '">' + a.linkText + "</a></li>"), o = p.find("> li.flexMenu-viewMore"), t(o) && p.find("> li:nth-last-child(2)").appendTo(w), w.children().each(function (e, t) {
                    w.prepend(t)
                }), o.append(w), s = p.find("> li.flexMenu-viewMore > a"), s.click(function (e) {
                    n(o), w.toggle(), o.toggleClass("active"), e.preventDefault()
                }), a.showOnHover && "undefined" != typeof Modernizr && !Modernizr.touch && o.hover(function () {
                    w.show(), e(this).addClass("active")
                }, function () {
                    w.hide(), e(this).removeClass("active")
                })
            } else if (a.undo && p.find("ul.flexMenu-popup")) {
                for (d = p.find("ul.flexMenu-popup"), l = d.find("li").length, c = 1; c <= l; c++)d.find("> li:first-child").appendTo(p);
                d.remove(), p.find("> li.flexMenu-viewMore").remove()
            }
        })
    }
}), function (e, t, n, i) {
    "use strict";
    var a = n("html"), r = n(e), o = n(t), s = n.fancybox = function () {
        s.open.apply(this, arguments)
    }, l = navigator.userAgent.match(/msie/i), d = null, c = t.createTouch !== i, p = function (e) {
        return e && e.hasOwnProperty && e instanceof n
    }, u = function (e) {
        return e && "string" === n.type(e)
    }, f = function (e) {
        return u(e) && e.indexOf("%") > 0
    }, h = function (e) {
        return e && !(e.style.overflow && "hidden" === e.style.overflow) && (e.clientWidth && e.scrollWidth > e.clientWidth || e.clientHeight && e.scrollHeight > e.clientHeight)
    }, m = function (e, t) {
        var n = parseInt(e, 10) || 0;
        return t && f(e) && (n = s.getViewport()[t] / 100 * n), Math.ceil(n)
    }, g = function (e, t) {
        return m(e, t) + "px"
    };
    n.extend(s, {
        version: "2.1.5",
        defaults: {
            padding: 15,
            margin: 20,
            width: 800,
            height: 600,
            minWidth: 100,
            minHeight: 100,
            maxWidth: 9999,
            maxHeight: 9999,
            pixelRatio: 1,
            autoSize: !0,
            autoHeight: !1,
            autoWidth: !1,
            autoResize: !0,
            autoCenter: !c,
            fitToView: !0,
            aspectRatio: !1,
            topRatio: .5,
            leftRatio: .5,
            scrolling: "auto",
            wrapCSS: "",
            arrows: !0,
            closeBtn: !0,
            closeClick: !1,
            nextClick: !1,
            mouseWheel: !0,
            autoPlay: !1,
            playSpeed: 3e3,
            preload: 3,
            modal: !1,
            loop: !0,
            ajax: {dataType: "html", headers: {"X-fancyBox": !0}},
            iframe: {scrolling: "auto", preload: !0},
            swf: {wmode: "transparent", allowfullscreen: "true", allowscriptaccess: "always"},
            keys: {
                next: {13: "left", 34: "up", 39: "left", 40: "up"},
                prev: {8: "right", 33: "down", 37: "right", 38: "down"},
                close: [27],
                play: [32],
                toggle: [70]
            },
            direction: {next: "left", prev: "right"},
            scrollOutside: !0,
            index: 0,
            type: null,
            href: null,
            content: null,
            title: null,
            tpl: {
                wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                image: '<img class="fancybox-image" src="{href}" alt="" />',
                iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (l ? ' allowtransparency="true"' : "") + "></iframe>",
                error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>',
                loading: '<div id="fancybox-loading"><div></div></div>'
            },
            openEffect: "fade",
            openSpeed: 250,
            openEasing: "swing",
            openOpacity: !0,
            openMethod: "zoomIn",
            closeEffect: "fade",
            closeSpeed: 250,
            closeEasing: "swing",
            closeOpacity: !0,
            closeMethod: "zoomOut",
            nextEffect: "elastic",
            nextSpeed: 250,
            nextEasing: "swing",
            nextMethod: "changeIn",
            prevEffect: "elastic",
            prevSpeed: 250,
            prevEasing: "swing",
            prevMethod: "changeOut",
            helpers: {overlay: !0, title: !0},
            onCancel: n.noop,
            beforeLoad: n.noop,
            afterLoad: n.noop,
            beforeShow: n.noop,
            afterShow: n.noop,
            beforeChange: n.noop,
            beforeClose: n.noop,
            afterClose: n.noop
        },
        group: {},
        opts: {},
        previous: null,
        coming: null,
        current: null,
        isActive: !1,
        isOpen: !1,
        isOpened: !1,
        wrap: null,
        skin: null,
        outer: null,
        inner: null,
        player: {timer: null, isActive: !1},
        ajaxLoad: null,
        imgPreload: null,
        transitions: {},
        helpers: {},
        open: function (e, t) {
            if (e && (n.isPlainObject(t) || (t = {}), !1 !== s.close(!0)))return n.isArray(e) || (e = p(e) ? n(e).get() : [e]), n.each(e, function (a, r) {
                var o, l, d, c, f, h, m, g = {};
                "object" === n.type(r) && (r.nodeType && (r = n(r)), p(r) ? (g = {
                    href: r.data("fancybox-href") || r.attr("href"),
                    title: n("<div/>").text(r.data("fancybox-title") || r.attr("title") || "").html(),
                    isDom: !0,
                    element: r
                }, n.metadata && n.extend(!0, g, r.metadata())) : g = r), o = t.href || g.href || (u(r) ? r : null), l = t.title !== i ? t.title : g.title || "", d = t.content || g.content, c = d ? "html" : t.type || g.type, !c && g.isDom && (c = r.data("fancybox-type"), c || (f = r.prop("class").match(/fancybox\.(\w+)/), c = f ? f[1] : null)), u(o) && (c || (s.isImage(o) ? c = "image" : s.isSWF(o) ? c = "swf" : "#" === o.charAt(0) ? c = "inline" : u(r) && (c = "html", d = r)), "ajax" === c && (h = o.split(/\s+/, 2), o = h.shift(), m = h.shift())), d || ("inline" === c ? o ? d = n(u(o) ? o.replace(/.*(?=#[^\s]+$)/, "") : o) : g.isDom && (d = r) : "html" === c ? d = o : c || o || !g.isDom || (c = "inline", d = r)), n.extend(g, {
                    href: o,
                    type: c,
                    content: d,
                    title: l,
                    selector: m
                }), e[a] = g
            }), s.opts = n.extend(!0, {}, s.defaults, t), t.keys !== i && (s.opts.keys = !!t.keys && n.extend({}, s.defaults.keys, t.keys)), s.group = e, s._start(s.opts.index)
        },
        cancel: function () {
            var e = s.coming;
            e && !1 === s.trigger("onCancel") || (s.hideLoading(), e && (s.ajaxLoad && s.ajaxLoad.abort(), s.ajaxLoad = null, s.imgPreload && (s.imgPreload.onload = s.imgPreload.onerror = null), e.wrap && e.wrap.stop(!0, !0).trigger("onReset").remove(), s.coming = null, s.current || s._afterZoomOut(e)))
        },
        close: function (e) {
            s.cancel(), !1 !== s.trigger("beforeClose") && (s.unbindEvents(), s.isActive && (s.isOpen && e !== !0 ? (s.isOpen = s.isOpened = !1, s.isClosing = !0, n(".fancybox-item, .fancybox-nav").remove(), s.wrap.stop(!0, !0).removeClass("fancybox-opened"), s.transitions[s.current.closeMethod]()) : (n(".fancybox-wrap").stop(!0).trigger("onReset").remove(), s._afterZoomOut())))
        },
        play: function (e) {
            var t = function () {
                clearTimeout(s.player.timer)
            }, n = function () {
                t(), s.current && s.player.isActive && (s.player.timer = setTimeout(s.next, s.current.playSpeed))
            }, i = function () {
                t(), o.unbind(".player"), s.player.isActive = !1, s.trigger("onPlayEnd")
            }, a = function () {
                s.current && (s.current.loop || s.current.index < s.group.length - 1) && (s.player.isActive = !0, o.bind({
                    "onCancel.player beforeClose.player": i,
                    "onUpdate.player": n,
                    "beforeLoad.player": t
                }), n(), s.trigger("onPlayStart"))
            };
            e === !0 || !s.player.isActive && e !== !1 ? a() : i()
        },
        next: function (e) {
            var t = s.current;
            t && (u(e) || (e = t.direction.next), s.jumpto(t.index + 1, e, "next"))
        },
        prev: function (e) {
            var t = s.current;
            t && (u(e) || (e = t.direction.prev), s.jumpto(t.index - 1, e, "prev"))
        },
        jumpto: function (e, t, n) {
            var a = s.current;
            a && (e = m(e), s.direction = t || a.direction[e >= a.index ? "next" : "prev"], s.router = n || "jumpto", a.loop && (e < 0 && (e = a.group.length + e % a.group.length), e %= a.group.length), a.group[e] !== i && (s.cancel(), s._start(e)))
        },
        reposition: function (e, t) {
            var i, a = s.current, r = a ? a.wrap : null;
            r && (i = s._getPosition(t), e && "scroll" === e.type ? (delete i.position, r.stop(!0, !0).animate(i, 200)) : (r.css(i), a.pos = n.extend({}, a.dim, i)))
        },
        update: function (e) {
            var t = e && e.originalEvent && e.originalEvent.type, n = !t || "orientationchange" === t;
            n && (clearTimeout(d), d = null), s.isOpen && !d && (d = setTimeout(function () {
                var i = s.current;
                i && !s.isClosing && (s.wrap.removeClass("fancybox-tmp"), (n || "load" === t || "resize" === t && i.autoResize) && s._setDimension(), "scroll" === t && i.canShrink || s.reposition(e), s.trigger("onUpdate"), d = null)
            }, n && !c ? 0 : 300))
        },
        toggle: function (e) {
            s.isOpen && (s.current.fitToView = "boolean" === n.type(e) ? e : !s.current.fitToView, c && (s.wrap.removeAttr("style").addClass("fancybox-tmp"), s.trigger("onUpdate")), s.update())
        },
        hideLoading: function () {
            o.unbind(".loading"), n("#fancybox-loading").remove()
        },
        showLoading: function () {
            var e, t;
            s.hideLoading(), e = n(s.opts.tpl.loading).click(s.cancel).appendTo("body"), o.bind("keydown.loading", function (e) {
                27 === (e.which || e.keyCode) && (e.preventDefault(), s.cancel())
            }), s.defaults.fixed || (t = s.getViewport(), e.css({
                position: "absolute",
                top: .5 * t.h + t.y,
                left: .5 * t.w + t.x
            })), s.trigger("onLoading")
        },
        getViewport: function () {
            var t = s.current && s.current.locked || !1, n = {x: r.scrollLeft(), y: r.scrollTop()};
            return t && t.length ? (n.w = t[0].clientWidth, n.h = t[0].clientHeight) : (n.w = c && e.innerWidth ? e.innerWidth : r.width(), n.h = c && e.innerHeight ? e.innerHeight : r.height()), n
        },
        unbindEvents: function () {
            s.wrap && p(s.wrap) && s.wrap.unbind(".fb"), o.unbind(".fb"), r.unbind(".fb")
        },
        bindEvents: function () {
            var e, t = s.current;
            t && (r.bind("orientationchange.fb" + (c ? "" : " resize.fb") + (t.autoCenter && !t.locked ? " scroll.fb" : ""), s.update), e = t.keys, e && o.bind("keydown.fb", function (a) {
                var r = a.which || a.keyCode, o = a.target || a.srcElement;
                return (27 !== r || !s.coming) && void(a.ctrlKey || a.altKey || a.shiftKey || a.metaKey || o && (o.type || n(o).is("[contenteditable]")) || n.each(e, function (e, o) {
                        return t.group.length > 1 && o[r] !== i ? (s[e](o[r]), a.preventDefault(), !1) : n.inArray(r, o) > -1 ? (s[e](), a.preventDefault(), !1) : void 0
                    }))
            }), n.fn.mousewheel && t.mouseWheel && s.wrap.bind("mousewheel.fb", function (e, i, a, r) {
                for (var o = e.target || null, l = n(o), d = !1; l.length && !(d || l.is(".fancybox-skin") || l.is(".fancybox-wrap"));)d = h(l[0]), l = n(l).parent();
                0 === i || d || s.group.length > 1 && !t.canShrink && (r > 0 || a > 0 ? s.prev(r > 0 ? "down" : "left") : (r < 0 || a < 0) && s.next(r < 0 ? "up" : "right"), e.preventDefault())
            }))
        },
        trigger: function (e, t) {
            var i, a = t || s.coming || s.current;
            if (a) {
                if (n.isFunction(a[e]) && (i = a[e].apply(a, Array.prototype.slice.call(arguments, 1))), i === !1)return !1;
                a.helpers && n.each(a.helpers, function (t, i) {
                    i && s.helpers[t] && n.isFunction(s.helpers[t][e]) && s.helpers[t][e](n.extend(!0, {}, s.helpers[t].defaults, i), a)
                })
            }
            o.trigger(e)
        },
        isImage: function (e) {
            return u(e) && e.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
        },
        isSWF: function (e) {
            return u(e) && e.match(/\.(swf)((\?|#).*)?$/i)
        },
        _start: function (e) {
            var t, i, a, r, o, l = {};
            if (e = m(e), t = s.group[e] || null, !t)return !1;
            if (l = n.extend(!0, {}, s.opts, t), r = l.margin, o = l.padding, "number" === n.type(r) && (l.margin = [r, r, r, r]), "number" === n.type(o) && (l.padding = [o, o, o, o]), l.modal && n.extend(!0, l, {
                    closeBtn: !1,
                    closeClick: !1,
                    nextClick: !1,
                    arrows: !1,
                    mouseWheel: !1,
                    keys: null,
                    helpers: {overlay: {closeClick: !1}}
                }), l.autoSize && (l.autoWidth = l.autoHeight = !0), "auto" === l.width && (l.autoWidth = !0), "auto" === l.height && (l.autoHeight = !0), l.group = s.group, l.index = e, s.coming = l, !1 === s.trigger("beforeLoad"))return void(s.coming = null);
            if (a = l.type, i = l.href, !a)return s.coming = null, !(!s.current || !s.router || "jumpto" === s.router) && (s.current.index = e, s[s.router](s.direction));
            if (s.isActive = !0, "image" !== a && "swf" !== a || (l.autoHeight = l.autoWidth = !1, l.scrolling = "visible"), "image" === a && (l.aspectRatio = !0), "iframe" === a && c && (l.scrolling = "scroll"), l.wrap = n(l.tpl.wrap).addClass("fancybox-" + (c ? "mobile" : "desktop") + " fancybox-type-" + a + " fancybox-tmp " + l.wrapCSS).appendTo(l.parent || "body"), n.extend(l, {
                    skin: n(".fancybox-skin", l.wrap),
                    outer: n(".fancybox-outer", l.wrap),
                    inner: n(".fancybox-inner", l.wrap)
                }), n.each(["Top", "Right", "Bottom", "Left"], function (e, t) {
                    l.skin.css("padding" + t, g(l.padding[e]))
                }), s.trigger("onReady"), "inline" === a || "html" === a) {
                if (!l.content || !l.content.length)return s._error("content")
            } else if (!i)return s._error("href");
            "image" === a ? s._loadImage() : "ajax" === a ? s._loadAjax() : "iframe" === a ? s._loadIframe() : s._afterLoad()
        },
        _error: function (e) {
            n.extend(s.coming, {
                type: "html",
                autoWidth: !0,
                autoHeight: !0,
                minWidth: 0,
                minHeight: 0,
                scrolling: "no",
                hasError: e,
                content: s.coming.tpl.error
            }), s._afterLoad()
        },
        _loadImage: function () {
            var e = s.imgPreload = new Image;
            e.onload = function () {
                this.onload = this.onerror = null, s.coming.width = this.width / s.opts.pixelRatio, s.coming.height = this.height / s.opts.pixelRatio, s._afterLoad()
            }, e.onerror = function () {
                this.onload = this.onerror = null, s._error("image")
            }, e.src = s.coming.href, e.complete !== !0 && s.showLoading()
        },
        _loadAjax: function () {
            var e = s.coming;
            s.showLoading(), s.ajaxLoad = n.ajax(n.extend({}, e.ajax, {
                url: e.href, error: function (e, t) {
                    s.coming && "abort" !== t ? s._error("ajax", e) : s.hideLoading()
                }, success: function (t, n) {
                    "success" === n && (e.content = t, s._afterLoad())
                }
            }))
        },
        _loadIframe: function () {
            var e = s.coming, t = n(e.tpl.iframe.replace(/\{rnd\}/g, (new Date).getTime())).attr("scrolling", c ? "auto" : e.iframe.scrolling).attr("src", e.href);
            n(e.wrap).bind("onReset", function () {
                try {
                    n(this).find("iframe").hide().attr("src", "//about:blank").end().empty()
                } catch (e) {
                }
            }), e.iframe.preload && (s.showLoading(), t.one("load", function () {
                n(this).data("ready", 1), c || n(this).bind("load.fb", s.update), n(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show(), s._afterLoad()
            })), e.content = t.appendTo(e.inner), e.iframe.preload || s._afterLoad()
        },
        _preloadImages: function () {
            var e, t, n = s.group, i = s.current, a = n.length, r = i.preload ? Math.min(i.preload, a - 1) : 0;
            for (t = 1; t <= r; t += 1)e = n[(i.index + t) % a], "image" === e.type && e.href && ((new Image).src = e.href)
        },
        _afterLoad: function () {
            var e, t, i, a, r, o, l = s.coming, d = s.current, c = "fancybox-placeholder";
            if (s.hideLoading(), l && s.isActive !== !1) {
                if (!1 === s.trigger("afterLoad", l, d))return l.wrap.stop(!0).trigger("onReset").remove(), void(s.coming = null);
                switch (d && (s.trigger("beforeChange", d), d.wrap.stop(!0).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove()), s.unbindEvents(), e = l, t = l.content, i = l.type, a = l.scrolling, n.extend(s, {
                    wrap: e.wrap,
                    skin: e.skin,
                    outer: e.outer,
                    inner: e.inner,
                    current: e,
                    previous: d
                }), r = e.href, i) {
                    case"inline":
                    case"ajax":
                    case"html":
                        e.selector ? t = n("<div>").html(t).find(e.selector) : p(t) && (t.data(c) || t.data(c, n('<div class="' + c + '"></div>').insertAfter(t).hide()), t = t.show().detach(), e.wrap.bind("onReset", function () {
                            n(this).find(t).length && t.hide().replaceAll(t.data(c)).data(c, !1)
                        }));
                        break;
                    case"image":
                        t = e.tpl.image.replace(/\{href\}/g, r);
                        break;
                    case"swf":
                        t = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + r + '"></param>', o = "", n.each(e.swf, function (e, n) {
                            t += '<param name="' + e + '" value="' + n + '"></param>', o += " " + e + '="' + n + '"'
                        }), t += '<embed src="' + r + '" type="application/x-shockwave-flash" width="100%" height="100%"' + o + "></embed></object>"
                }
                p(t) && t.parent().is(e.inner) || e.inner.append(t), s.trigger("beforeShow"), e.inner.css("overflow", "yes" === a ? "scroll" : "no" === a ? "hidden" : a), s._setDimension(), s.reposition(), s.isOpen = !1, s.coming = null, s.bindEvents(), s.isOpened ? d.prevMethod && s.transitions[d.prevMethod]() : n(".fancybox-wrap").not(e.wrap).stop(!0).trigger("onReset").remove(), s.transitions[s.isOpened ? e.nextMethod : e.openMethod](), s._preloadImages()
            }
        },
        _setDimension: function () {
            var e, t, i, a, r, o, l, d, c, p, u, h, v, y, w, x = s.getViewport(), b = 0, C = !1, T = !1, S = s.wrap, k = s.skin, E = s.inner, M = s.current, z = M.width, P = M.height, D = M.minWidth, L = M.minHeight, A = M.maxWidth, H = M.maxHeight, I = M.scrolling, j = M.scrollOutside ? M.scrollbarWidth : 0, N = M.margin, O = m(N[1] + N[3]), q = m(N[0] + N[2]);
            if (S.add(k).add(E).width("auto").height("auto").removeClass("fancybox-tmp"), e = m(k.outerWidth(!0) - k.width()), t = m(k.outerHeight(!0) - k.height()), i = O + e, a = q + t, r = f(z) ? (x.w - i) * m(z) / 100 : z, o = f(P) ? (x.h - a) * m(P) / 100 : P, "iframe" === M.type) {
                if (y = M.content, M.autoHeight && y && 1 === y.data("ready"))try {
                    y[0].contentWindow.document.location && (E.width(r).height(9999), w = y.contents().find("body"), j && w.css("overflow-x", "hidden"), o = w.outerHeight(!0))
                } catch (W) {
                }
            } else(M.autoWidth || M.autoHeight) && (E.addClass("fancybox-tmp"), M.autoWidth || E.width(r), M.autoHeight || E.height(o), M.autoWidth && (r = E.width()), M.autoHeight && (o = E.height()), E.removeClass("fancybox-tmp"));
            if (z = m(r), P = m(o), c = r / o, D = m(f(D) ? m(D, "w") - i : D), A = m(f(A) ? m(A, "w") - i : A), L = m(f(L) ? m(L, "h") - a : L), H = m(f(H) ? m(H, "h") - a : H), l = A, d = H, M.fitToView && (A = Math.min(x.w - i, A), H = Math.min(x.h - a, H)), h = x.w - O, v = x.h - q, M.aspectRatio ? (z > A && (z = A, P = m(z / c)), P > H && (P = H, z = m(P * c)),
                z < D && (z = D, P = m(z / c)), P < L && (P = L, z = m(P * c))) : (z = Math.max(D, Math.min(z, A)), M.autoHeight && "iframe" !== M.type && (E.width(z), P = E.height()), P = Math.max(L, Math.min(P, H))), M.fitToView)if (E.width(z).height(P), S.width(z + e), p = S.width(), u = S.height(), M.aspectRatio)for (; (p > h || u > v) && z > D && P > L && !(b++ > 19);)P = Math.max(L, Math.min(H, P - 10)), z = m(P * c), z < D && (z = D, P = m(z / c)), z > A && (z = A, P = m(z / c)), E.width(z).height(P), S.width(z + e), p = S.width(), u = S.height(); else z = Math.max(D, Math.min(z, z - (p - h))), P = Math.max(L, Math.min(P, P - (u - v)));
            j && "auto" === I && P < o && z + e + j < h && (z += j), E.width(z).height(P), S.width(z + e), p = S.width(), u = S.height(), C = (p > h || u > v) && z > D && P > L, T = M.aspectRatio ? z < l && P < d && z < r && P < o : (z < l || P < d) && (z < r || P < o), n.extend(M, {
                dim: {
                    width: g(p),
                    height: g(u)
                },
                origWidth: r,
                origHeight: o,
                canShrink: C,
                canExpand: T,
                wPadding: e,
                hPadding: t,
                wrapSpace: u - k.outerHeight(!0),
                skinSpace: k.height() - P
            }), !y && M.autoHeight && P > L && P < H && !T && E.height("auto")
        },
        _getPosition: function (e) {
            var t = s.current, n = s.getViewport(), i = t.margin, a = s.wrap.width() + i[1] + i[3], r = s.wrap.height() + i[0] + i[2], o = {
                position: "absolute",
                top: i[0],
                left: i[3]
            };
            return t.autoCenter && t.fixed && !e && r <= n.h && a <= n.w ? o.position = "fixed" : t.locked || (o.top += n.y, o.left += n.x), o.top = g(Math.max(o.top, o.top + (n.h - r) * t.topRatio)), o.left = g(Math.max(o.left, o.left + (n.w - a) * t.leftRatio)), o
        },
        _afterZoomIn: function () {
            var e = s.current;
            e && (s.isOpen = s.isOpened = !0, s.wrap.css("overflow", "visible").addClass("fancybox-opened").hide().show(0), s.update(), (e.closeClick || e.nextClick && s.group.length > 1) && s.inner.css("cursor", "pointer").bind("click.fb", function (t) {
                n(t.target).is("a") || n(t.target).parent().is("a") || (t.preventDefault(), s[e.closeClick ? "close" : "next"]())
            }), e.closeBtn && n(e.tpl.closeBtn).appendTo(s.skin).bind("click.fb", function (e) {
                e.preventDefault(), s.close()
            }), e.arrows && s.group.length > 1 && ((e.loop || e.index > 0) && n(e.tpl.prev).appendTo(s.outer).bind("click.fb", s.prev), (e.loop || e.index < s.group.length - 1) && n(e.tpl.next).appendTo(s.outer).bind("click.fb", s.next)), s.trigger("afterShow"), e.loop || e.index !== e.group.length - 1 ? s.opts.autoPlay && !s.player.isActive && (s.opts.autoPlay = !1, s.play(!0)) : s.play(!1))
        },
        _afterZoomOut: function (e) {
            e = e || s.current, n(".fancybox-wrap").trigger("onReset").remove(), n.extend(s, {
                group: {},
                opts: {},
                router: !1,
                current: null,
                isActive: !1,
                isOpened: !1,
                isOpen: !1,
                isClosing: !1,
                wrap: null,
                skin: null,
                outer: null,
                inner: null
            }), s.trigger("afterClose", e)
        }
    }), s.transitions = {
        getOrigPosition: function () {
            var e = s.current, t = e.element, n = e.orig, i = {}, a = 50, r = 50, o = e.hPadding, l = e.wPadding, d = s.getViewport();
            return !n && e.isDom && t.is(":visible") && (n = t.find("img:first"), n.length || (n = t)), p(n) ? (i = n.offset(), n.is("img") && (a = n.outerWidth(), r = n.outerHeight())) : (i.top = d.y + (d.h - r) * e.topRatio, i.left = d.x + (d.w - a) * e.leftRatio), ("fixed" === s.wrap.css("position") || e.locked) && (i.top -= d.y, i.left -= d.x), i = {
                top: g(i.top - o * e.topRatio),
                left: g(i.left - l * e.leftRatio),
                width: g(a + l),
                height: g(r + o)
            }
        }, step: function (e, t) {
            var n, i, a, r = t.prop, o = s.current, l = o.wrapSpace, d = o.skinSpace;
            "width" !== r && "height" !== r || (n = t.end === t.start ? 1 : (e - t.start) / (t.end - t.start), s.isClosing && (n = 1 - n), i = "width" === r ? o.wPadding : o.hPadding, a = e - i, s.skin[r](m("width" === r ? a : a - l * n)), s.inner[r](m("width" === r ? a : a - l * n - d * n)))
        }, zoomIn: function () {
            var e = s.current, t = e.pos, i = e.openEffect, a = "elastic" === i, r = n.extend({opacity: 1}, t);
            delete r.position, a ? (t = this.getOrigPosition(), e.openOpacity && (t.opacity = .1)) : "fade" === i && (t.opacity = .1), s.wrap.css(t).animate(r, {
                duration: "none" === i ? 0 : e.openSpeed,
                easing: e.openEasing,
                step: a ? this.step : null,
                complete: s._afterZoomIn
            })
        }, zoomOut: function () {
            var e = s.current, t = e.closeEffect, n = "elastic" === t, i = {opacity: .1};
            n && (i = this.getOrigPosition(), e.closeOpacity && (i.opacity = .1)), s.wrap.animate(i, {
                duration: "none" === t ? 0 : e.closeSpeed,
                easing: e.closeEasing,
                step: n ? this.step : null,
                complete: s._afterZoomOut
            })
        }, changeIn: function () {
            var e, t = s.current, n = t.nextEffect, i = t.pos, a = {opacity: 1}, r = s.direction, o = 200;
            i.opacity = .1, "elastic" === n && (e = "down" === r || "up" === r ? "top" : "left", "down" === r || "right" === r ? (i[e] = g(m(i[e]) - o), a[e] = "+=" + o + "px") : (i[e] = g(m(i[e]) + o), a[e] = "-=" + o + "px")), "none" === n ? s._afterZoomIn() : s.wrap.css(i).animate(a, {
                duration: t.nextSpeed,
                easing: t.nextEasing,
                complete: s._afterZoomIn
            })
        }, changeOut: function () {
            var e = s.previous, t = e.prevEffect, i = {opacity: .1}, a = s.direction, r = 200;
            "elastic" === t && (i["down" === a || "up" === a ? "top" : "left"] = ("up" === a || "left" === a ? "-" : "+") + "=" + r + "px"), e.wrap.animate(i, {
                duration: "none" === t ? 0 : e.prevSpeed,
                easing: e.prevEasing,
                complete: function () {
                    n(this).trigger("onReset").remove()
                }
            })
        }
    }, s.helpers.overlay = {
        defaults: {closeClick: !0, speedOut: 200, showEarly: !0, css: {}, locked: !c, fixed: !0},
        overlay: null,
        fixed: !1,
        el: n("html"),
        create: function (e) {
            var t;
            e = n.extend({}, this.defaults, e), this.overlay && this.close(), t = s.coming ? s.coming.parent : e.parent, this.overlay = n('<div class="fancybox-overlay"></div>').appendTo(t && t.length ? t : "body"), this.fixed = !1, e.fixed && s.defaults.fixed && (this.overlay.addClass("fancybox-overlay-fixed"), this.fixed = !0)
        },
        open: function (e) {
            var t = this;
            e = n.extend({}, this.defaults, e), this.overlay ? this.overlay.unbind(".overlay").width("auto").height("auto") : this.create(e), this.fixed || (r.bind("resize.overlay", n.proxy(this.update, this)), this.update()), e.closeClick && this.overlay.bind("click.overlay", function (e) {
                if (n(e.target).hasClass("fancybox-overlay"))return s.isActive ? s.close() : t.close(), !1
            }), this.overlay.css(e.css).show()
        },
        close: function () {
            r.unbind("resize.overlay"), this.el.hasClass("fancybox-lock") && (n(".fancybox-margin").removeClass("fancybox-margin"), this.el.removeClass("fancybox-lock"), r.scrollTop(this.scrollV).scrollLeft(this.scrollH)), n(".fancybox-overlay").remove().hide(), n.extend(this, {
                overlay: null,
                fixed: !1
            })
        },
        update: function () {
            var e, n = "100%";
            this.overlay.width(n).height("100%"), l ? (e = Math.max(t.documentElement.offsetWidth, t.body.offsetWidth), o.width() > e && (n = o.width())) : o.width() > r.width() && (n = o.width()), this.overlay.width(n).height(o.height())
        },
        onReady: function (e, t) {
            var i = this.overlay;
            n(".fancybox-overlay").stop(!0, !0), i || this.create(e), e.locked && this.fixed && t.fixed && (t.locked = this.overlay.append(t.wrap), t.fixed = !1), e.showEarly === !0 && this.beforeShow.apply(this, arguments)
        },
        beforeShow: function (e, t) {
            t.locked && !this.el.hasClass("fancybox-lock") && (this.fixPosition !== !1 && n("*:not(object)").filter(function () {
                return "fixed" === n(this).css("position") && !n(this).hasClass("fancybox-overlay") && !n(this).hasClass("fancybox-wrap")
            }).addClass("fancybox-margin"), this.el.addClass("fancybox-margin"), this.scrollV = r.scrollTop(), this.scrollH = r.scrollLeft(), this.el.addClass("fancybox-lock"), r.scrollTop(this.scrollV).scrollLeft(this.scrollH)), this.open(e)
        },
        onUpdate: function () {
            this.fixed || this.update()
        },
        afterClose: function (e) {
            this.overlay && !s.coming && this.overlay.fadeOut(e.speedOut, n.proxy(this.close, this))
        }
    }, s.helpers.title = {
        defaults: {type: "float", position: "bottom"}, beforeShow: function (e) {
            var t, i, a = s.current, r = a.title, o = e.type;
            if (n.isFunction(r) && (r = r.call(a.element, a)), u(r) && "" !== n.trim(r)) {
                switch (t = n('<div class="fancybox-title fancybox-title-' + o + '-wrap">' + r + "</div>"), o) {
                    case"inside":
                        i = s.skin;
                        break;
                    case"outside":
                        i = s.wrap;
                        break;
                    case"over":
                        i = s.inner;
                        break;
                    default:
                        i = s.skin, t.appendTo("body"), l && t.width(t.width()), t.wrapInner('<span class="child"></span>'), s.current.margin[2] += Math.abs(m(t.css("margin-bottom")))
                }
                t["top" === e.position ? "prependTo" : "appendTo"](i)
            }
        }
    }, n.fn.fancybox = function (e) {
        var t, i = n(this), a = this.selector || "", r = function (r) {
            var o, l, d = n(this).blur(), c = t;
            r.ctrlKey || r.altKey || r.shiftKey || r.metaKey || d.is(".fancybox-wrap") || (o = e.groupAttr || "data-fancybox-group", l = d.attr(o), l || (o = "rel", l = d.get(0)[o]), l && "" !== l && "nofollow" !== l && (d = a.length ? n(a) : i, d = d.filter("[" + o + '="' + l + '"]'), c = d.index(this)), e.index = c, s.open(d, e) !== !1 && r.preventDefault())
        };
        return e = e || {}, t = e.index || 0, a && e.live !== !1 ? o.undelegate(a, "click.fb-start").delegate(a + ":not('.fancybox-item, .fancybox-nav')", "click.fb-start", r) : i.unbind("click.fb-start").bind("click.fb-start", r), this.filter("[data-fancybox-start=1]").trigger("click"), this
    }, o.ready(function () {
        var t, r;
        n.scrollbarWidth === i && (n.scrollbarWidth = function () {
            var e = n('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"), t = e.children(), i = t.innerWidth() - t.height(99).innerWidth();
            return e.remove(), i
        }), n.support.fixedPosition === i && (n.support.fixedPosition = function () {
            var e = n('<div style="position:fixed;top:20px;"></div>').appendTo("body"), t = 20 === e[0].offsetTop || 15 === e[0].offsetTop;
            return e.remove(), t
        }()), n.extend(s.defaults, {
            scrollbarWidth: n.scrollbarWidth(),
            fixed: n.support.fixedPosition,
            parent: n("body")
        }), t = n(e).width(), a.addClass("fancybox-lock-test"), r = n(e).width(), a.removeClass("fancybox-lock-test"), n("<style type='text/css'>.fancybox-margin{margin-right:" + (r - t) + "px;}</style>").appendTo("head")
    })
}(window, document, jQuery), function (e, t, n, i) {
    var a = n("html"), r = n(e), o = n(t), s = n.fancybox = function () {
        s.open.apply(this, arguments)
    }, l = navigator.userAgent.match(/msie/i), d = null, c = t.createTouch !== i, p = function (e) {
        return e && e.hasOwnProperty && e instanceof n
    }, u = function (e) {
        return e && "string" === n.type(e)
    }, f = function (e) {
        return u(e) && 0 < e.indexOf("%")
    }, h = function (e, t) {
        var n = parseInt(e, 10) || 0;
        return t && f(e) && (n *= s.getViewport()[t] / 100), Math.ceil(n)
    }, m = function (e, t) {
        return h(e, t) + "px"
    };
    n.extend(s, {
        version: "2.1.5",
        defaults: {
            padding: 15,
            margin: 20,
            width: 800,
            height: 600,
            minWidth: 100,
            minHeight: 100,
            maxWidth: 9999,
            maxHeight: 9999,
            pixelRatio: 1,
            autoSize: !0,
            autoHeight: !1,
            autoWidth: !1,
            autoResize: !0,
            autoCenter: !c,
            fitToView: !0,
            aspectRatio: !1,
            topRatio: .5,
            leftRatio: .5,
            scrolling: "auto",
            wrapCSS: "",
            arrows: !0,
            closeBtn: !0,
            closeClick: !1,
            nextClick: !1,
            mouseWheel: !0,
            autoPlay: !1,
            playSpeed: 3e3,
            preload: 3,
            modal: !1,
            loop: !0,
            ajax: {dataType: "html", headers: {"X-fancyBox": !0}},
            iframe: {scrolling: "auto", preload: !0},
            swf: {wmode: "transparent", allowfullscreen: "true", allowscriptaccess: "always"},
            keys: {
                next: {13: "left", 34: "up", 39: "left", 40: "up"},
                prev: {8: "right", 33: "down", 37: "right", 38: "down"},
                close: [27],
                play: [32],
                toggle: [70]
            },
            direction: {next: "left", prev: "right"},
            scrollOutside: !0,
            index: 0,
            type: null,
            href: null,
            content: null,
            title: null,
            tpl: {
                wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                image: '<img class="fancybox-image" src="{href}" alt="" />',
                iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (l ? ' allowtransparency="true"' : "") + "></iframe>",
                error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
            },
            openEffect: "fade",
            openSpeed: 250,
            openEasing: "swing",
            openOpacity: !0,
            openMethod: "zoomIn",
            closeEffect: "fade",
            closeSpeed: 250,
            closeEasing: "swing",
            closeOpacity: !0,
            closeMethod: "zoomOut",
            nextEffect: "elastic",
            nextSpeed: 250,
            nextEasing: "swing",
            nextMethod: "changeIn",
            prevEffect: "elastic",
            prevSpeed: 250,
            prevEasing: "swing",
            prevMethod: "changeOut",
            helpers: {overlay: !0, title: !0},
            onCancel: n.noop,
            beforeLoad: n.noop,
            afterLoad: n.noop,
            beforeShow: n.noop,
            afterShow: n.noop,
            beforeChange: n.noop,
            beforeClose: n.noop,
            afterClose: n.noop
        },
        group: {},
        opts: {},
        previous: null,
        coming: null,
        current: null,
        isActive: !1,
        isOpen: !1,
        isOpened: !1,
        wrap: null,
        skin: null,
        outer: null,
        inner: null,
        player: {timer: null, isActive: !1},
        ajaxLoad: null,
        imgPreload: null,
        transitions: {},
        helpers: {},
        open: function (e, t) {
            if (e && (n.isPlainObject(t) || (t = {}), !1 !== s.close(!0)))return n.isArray(e) || (e = p(e) ? n(e).get() : [e]), n.each(e, function (a, r) {
                var o, l, d, c, f, h = {};
                "object" === n.type(r) && (r.nodeType && (r = n(r)), p(r) ? (h = {
                    href: r.data("fancybox-href") || r.attr("href"),
                    title: n("<div/>").text(r.data("fancybox-title") || r.attr("title")).html(),
                    isDom: !0,
                    element: r
                }, n.metadata && n.extend(!0, h, r.metadata())) : h = r), o = t.href || h.href || (u(r) ? r : null), l = t.title !== i ? t.title : h.title || "", c = (d = t.content || h.content) ? "html" : t.type || h.type, !c && h.isDom && (c = r.data("fancybox-type"), c || (c = (c = r.prop("class").match(/fancybox\.(\w+)/)) ? c[1] : null)), u(o) && (c || (s.isImage(o) ? c = "image" : s.isSWF(o) ? c = "swf" : "#" === o.charAt(0) ? c = "inline" : u(r) && (c = "html", d = r)), "ajax" === c && (f = o.split(/\s+/, 2), o = f.shift(), f = f.shift())), d || ("inline" === c ? o ? d = n(u(o) ? o.replace(/.*(?=#[^\s]+$)/, "") : o) : h.isDom && (d = r) : "html" === c ? d = o : c || o || !h.isDom || (c = "inline", d = r)), n.extend(h, {
                    href: o,
                    type: c,
                    content: d,
                    title: l,
                    selector: f
                }), e[a] = h
            }), s.opts = n.extend(!0, {}, s.defaults, t), t.keys !== i && (s.opts.keys = !!t.keys && n.extend({}, s.defaults.keys, t.keys)), s.group = e, s._start(s.opts.index)
        },
        cancel: function () {
            var e = s.coming;
            e && !1 === s.trigger("onCancel") || (s.hideLoading(), e && (s.ajaxLoad && s.ajaxLoad.abort(), s.ajaxLoad = null, s.imgPreload && (s.imgPreload.onload = s.imgPreload.onerror = null), e.wrap && e.wrap.stop(!0, !0).trigger("onReset").remove(), s.coming = null, s.current || s._afterZoomOut(e)))
        },
        close: function (e) {
            s.cancel(), !1 !== s.trigger("beforeClose") && (s.unbindEvents(), s.isActive && (s.isOpen && !0 !== e ? (s.isOpen = s.isOpened = !1, s.isClosing = !0, n(".fancybox-item, .fancybox-nav").remove(), s.wrap.stop(!0, !0).removeClass("fancybox-opened"), s.transitions[s.current.closeMethod]()) : (n(".fancybox-wrap").stop(!0).trigger("onReset").remove(), s._afterZoomOut())))
        },
        play: function (e) {
            var t = function () {
                clearTimeout(s.player.timer)
            }, n = function () {
                t(), s.current && s.player.isActive && (s.player.timer = setTimeout(s.next, s.current.playSpeed))
            }, i = function () {
                t(), o.unbind(".player"), s.player.isActive = !1, s.trigger("onPlayEnd")
            };
            !0 === e || !s.player.isActive && !1 !== e ? s.current && (s.current.loop || s.current.index < s.group.length - 1) && (s.player.isActive = !0, o.bind({
                "onCancel.player beforeClose.player": i,
                "onUpdate.player": n,
                "beforeLoad.player": t
            }), n(), s.trigger("onPlayStart")) : i()
        },
        next: function (e) {
            var t = s.current;
            t && (u(e) || (e = t.direction.next), s.jumpto(t.index + 1, e, "next"))
        },
        prev: function (e) {
            var t = s.current;
            t && (u(e) || (e = t.direction.prev), s.jumpto(t.index - 1, e, "prev"))
        },
        jumpto: function (e, t, n) {
            var a = s.current;
            a && (e = h(e), s.direction = t || a.direction[e >= a.index ? "next" : "prev"], s.router = n || "jumpto", a.loop && (0 > e && (e = a.group.length + e % a.group.length), e %= a.group.length), a.group[e] !== i && (s.cancel(), s._start(e)))
        },
        reposition: function (e, t) {
            var i, a = s.current, r = a ? a.wrap : null;
            r && (i = s._getPosition(t), e && "scroll" === e.type ? (delete i.position, r.stop(!0, !0).animate(i, 200)) : (r.css(i), a.pos = n.extend({}, a.dim, i)))
        },
        update: function (e) {
            var t = e && e.originalEvent && e.originalEvent.type, n = !t || "orientationchange" === t;
            n && (clearTimeout(d), d = null), s.isOpen && !d && (d = setTimeout(function () {
                var i = s.current;
                i && !s.isClosing && (s.wrap.removeClass("fancybox-tmp"), (n || "load" === t || "resize" === t && i.autoResize) && s._setDimension(), "scroll" === t && i.canShrink || s.reposition(e), s.trigger("onUpdate"), d = null)
            }, n && !c ? 0 : 300))
        },
        toggle: function (e) {
            s.isOpen && (s.current.fitToView = "boolean" === n.type(e) ? e : !s.current.fitToView, c && (s.wrap.removeAttr("style").addClass("fancybox-tmp"), s.trigger("onUpdate")), s.update())
        },
        hideLoading: function () {
            o.unbind(".loading"), n("#fancybox-loading").remove()
        },
        showLoading: function () {
            var e, t;
            s.hideLoading(), e = n('<div id="fancybox-loading"><div></div></div>').click(s.cancel).appendTo("body"), o.bind("keydown.loading", function (e) {
                27 === (e.which || e.keyCode) && (e.preventDefault(), s.cancel())
            }), s.defaults.fixed || (t = s.getViewport(), e.css({
                position: "absolute",
                top: .5 * t.h + t.y,
                left: .5 * t.w + t.x
            })), s.trigger("onLoading")
        },
        getViewport: function () {
            var t = s.current && s.current.locked || !1, n = {x: r.scrollLeft(), y: r.scrollTop()};
            return t && t.length ? (n.w = t[0].clientWidth, n.h = t[0].clientHeight) : (n.w = c && e.innerWidth ? e.innerWidth : r.width(), n.h = c && e.innerHeight ? e.innerHeight : r.height()), n
        },
        unbindEvents: function () {
            s.wrap && p(s.wrap) && s.wrap.unbind(".fb"), o.unbind(".fb"), r.unbind(".fb")
        },
        bindEvents: function () {
            var e, t = s.current;
            t && (r.bind("orientationchange.fb" + (c ? "" : " resize.fb") + (t.autoCenter && !t.locked ? " scroll.fb" : ""), s.update), (e = t.keys) && o.bind("keydown.fb", function (a) {
                var r = a.which || a.keyCode, o = a.target || a.srcElement;
                return (27 !== r || !s.coming) && void(a.ctrlKey || a.altKey || a.shiftKey || a.metaKey || o && (o.type || n(o).is("[contenteditable]")) || n.each(e, function (e, o) {
                        return 1 < t.group.length && o[r] !== i ? (s[e](o[r]), a.preventDefault(), !1) : -1 < n.inArray(r, o) ? (s[e](), a.preventDefault(), !1) : void 0
                    }))
            }), n.fn.mousewheel && t.mouseWheel && s.wrap.bind("mousewheel.fb", function (e, i, a, r) {
                for (var o = n(e.target || null), l = !1; o.length && !(l || o.is(".fancybox-skin") || o.is(".fancybox-wrap"));)l = o[0] && !(o[0].style.overflow && "hidden" === o[0].style.overflow) && (o[0].clientWidth && o[0].scrollWidth > o[0].clientWidth || o[0].clientHeight && o[0].scrollHeight > o[0].clientHeight), o = n(o).parent();
                0 !== i && !l && 1 < s.group.length && !t.canShrink && (0 < r || 0 < a ? s.prev(0 < r ? "down" : "left") : (0 > r || 0 > a) && s.next(0 > r ? "up" : "right"), e.preventDefault())
            }))
        },
        trigger: function (e, t) {
            var i, a = t || s.coming || s.current;
            if (a) {
                if (n.isFunction(a[e]) && (i = a[e].apply(a, Array.prototype.slice.call(arguments, 1))), !1 === i)return !1;
                a.helpers && n.each(a.helpers, function (t, i) {
                    i && s.helpers[t] && n.isFunction(s.helpers[t][e]) && s.helpers[t][e](n.extend(!0, {}, s.helpers[t].defaults, i), a)
                })
            }
            o.trigger(e)
        },
        isImage: function (e) {
            return u(e) && e.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
        },
        isSWF: function (e) {
            return u(e) && e.match(/\.(swf)((\?|#).*)?$/i)
        },
        _start: function (e) {
            var t, i, a = {};
            if (e = h(e), t = s.group[e] || null, !t)return !1;
            if (a = n.extend(!0, {}, s.opts, t), t = a.margin, i = a.padding, "number" === n.type(t) && (a.margin = [t, t, t, t]), "number" === n.type(i) && (a.padding = [i, i, i, i]), a.modal && n.extend(!0, a, {
                    closeBtn: !1,
                    closeClick: !1,
                    nextClick: !1,
                    arrows: !1,
                    mouseWheel: !1,
                    keys: null,
                    helpers: {overlay: {closeClick: !1}}
                }), a.autoSize && (a.autoWidth = a.autoHeight = !0), "auto" === a.width && (a.autoWidth = !0), "auto" === a.height && (a.autoHeight = !0), a.group = s.group, a.index = e, s.coming = a, !1 === s.trigger("beforeLoad"))s.coming = null; else {
                if (i = a.type, t = a.href, !i)return s.coming = null, !(!s.current || !s.router || "jumpto" === s.router) && (s.current.index = e, s[s.router](s.direction));
                if (s.isActive = !0, "image" !== i && "swf" !== i || (a.autoHeight = a.autoWidth = !1, a.scrolling = "visible"), "image" === i && (a.aspectRatio = !0), "iframe" === i && c && (a.scrolling = "scroll"), a.wrap = n(a.tpl.wrap).addClass("fancybox-" + (c ? "mobile" : "desktop") + " fancybox-type-" + i + " fancybox-tmp " + a.wrapCSS).appendTo(a.parent || "body"), n.extend(a, {
                        skin: n(".fancybox-skin", a.wrap),
                        outer: n(".fancybox-outer", a.wrap),
                        inner: n(".fancybox-inner", a.wrap)
                    }), n.each(["Top", "Right", "Bottom", "Left"], function (e, t) {
                        a.skin.css("padding" + t, m(a.padding[e]))
                    }), s.trigger("onReady"), "inline" === i || "html" === i) {
                    if (!a.content || !a.content.length)return s._error("content")
                } else if (!t)return s._error("href");
                "image" === i ? s._loadImage() : "ajax" === i ? s._loadAjax() : "iframe" === i ? s._loadIframe() : s._afterLoad()
            }
        },
        _error: function (e) {
            n.extend(s.coming, {
                type: "html",
                autoWidth: !0,
                autoHeight: !0,
                minWidth: 0,
                minHeight: 0,
                scrolling: "no",
                hasError: e,
                content: s.coming.tpl.error
            }), s._afterLoad()
        },
        _loadImage: function () {
            var e = s.imgPreload = new Image;
            e.onload = function () {
                this.onload = this.onerror = null, s.coming.width = this.width / s.opts.pixelRatio, s.coming.height = this.height / s.opts.pixelRatio, s._afterLoad()
            }, e.onerror = function () {
                this.onload = this.onerror = null, s._error("image")
            }, e.src = s.coming.href, !0 !== e.complete && s.showLoading()
        },
        _loadAjax: function () {
            var e = s.coming;
            s.showLoading(), s.ajaxLoad = n.ajax(n.extend({}, e.ajax, {
                url: e.href, error: function (e, t) {
                    s.coming && "abort" !== t ? s._error("ajax", e) : s.hideLoading()
                }, success: function (t, n) {
                    "success" === n && (e.content = t, s._afterLoad())
                }
            }))
        },
        _loadIframe: function () {
            var e = s.coming, t = n(e.tpl.iframe.replace(/\{rnd\}/g, (new Date).getTime())).attr("scrolling", c ? "auto" : e.iframe.scrolling).attr("src", e.href);
            n(e.wrap).bind("onReset", function () {
                try {
                    n(this).find("iframe").hide().attr("src", "//about:blank").end().empty()
                } catch (e) {
                }
            }), e.iframe.preload && (s.showLoading(), t.one("load", function () {
                n(this).data("ready", 1), c || n(this).bind("load.fb", s.update), n(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show(), s._afterLoad()
            })), e.content = t.appendTo(e.inner), e.iframe.preload || s._afterLoad()
        },
        _preloadImages: function () {
            var e, t, n = s.group, i = s.current, a = n.length, r = i.preload ? Math.min(i.preload, a - 1) : 0;
            for (t = 1; t <= r; t += 1)e = n[(i.index + t) % a], "image" === e.type && e.href && ((new Image).src = e.href)
        },
        _afterLoad: function () {
            var e, t, i, a, r, o = s.coming, l = s.current;
            if (s.hideLoading(), o && !1 !== s.isActive)if (!1 === s.trigger("afterLoad", o, l))o.wrap.stop(!0).trigger("onReset").remove(), s.coming = null; else {
                switch (l && (s.trigger("beforeChange", l), l.wrap.stop(!0).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove()), s.unbindEvents(), e = o.content, t = o.type, i = o.scrolling, n.extend(s, {
                    wrap: o.wrap,
                    skin: o.skin,
                    outer: o.outer,
                    inner: o.inner,
                    current: o,
                    previous: l
                }), a = o.href, t) {
                    case"inline":
                    case"ajax":
                    case"html":
                        o.selector ? e = n("<div>").html(e).find(o.selector) : p(e) && (e.data("fancybox-placeholder") || e.data("fancybox-placeholder", n('<div class="fancybox-placeholder"></div>').insertAfter(e).hide()), e = e.show().detach(), o.wrap.bind("onReset", function () {
                            n(this).find(e).length && e.hide().replaceAll(e.data("fancybox-placeholder")).data("fancybox-placeholder", !1)
                        }));
                        break;
                    case"image":
                        e = o.tpl.image.replace(/\{href\}/g, a);
                        break;
                    case"swf":
                        e = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + a + '"></param>', r = "", n.each(o.swf, function (t, n) {
                            e += '<param name="' + t + '" value="' + n + '"></param>', r += " " + t + '="' + n + '"'
                        }), e += '<embed src="' + a + '" type="application/x-shockwave-flash" width="100%" height="100%"' + r + "></embed></object>"
                }
                p(e) && e.parent().is(o.inner) || o.inner.append(e), s.trigger("beforeShow"), o.inner.css("overflow", "yes" === i ? "scroll" : "no" === i ? "hidden" : i), s._setDimension(), s.reposition(), s.isOpen = !1, s.coming = null, s.bindEvents(), s.isOpened ? l.prevMethod && s.transitions[l.prevMethod]() : n(".fancybox-wrap").not(o.wrap).stop(!0).trigger("onReset").remove(), s.transitions[s.isOpened ? o.nextMethod : o.openMethod](), s._preloadImages()
            }
        },
        _setDimension: function () {
            var e, t, i, a, r, o, l, d, c, p = s.getViewport(), u = 0, g = !1, v = !1, g = s.wrap, y = s.skin, w = s.inner, x = s.current, v = x.width, b = x.height, C = x.minWidth, T = x.minHeight, S = x.maxWidth, k = x.maxHeight, E = x.scrolling, M = x.scrollOutside ? x.scrollbarWidth : 0, z = x.margin, P = h(z[1] + z[3]), D = h(z[0] + z[2]);
            if (g.add(y).add(w).width("auto").height("auto").removeClass("fancybox-tmp"), z = h(y.outerWidth(!0) - y.width()), e = h(y.outerHeight(!0) - y.height()), t = P + z, i = D + e, a = f(v) ? (p.w - t) * h(v) / 100 : v, r = f(b) ? (p.h - i) * h(b) / 100 : b, "iframe" === x.type) {
                if (c = x.content, x.autoHeight && 1 === c.data("ready"))try {
                    c[0].contentWindow.document.location && (w.width(a).height(9999), o = c.contents().find("body"), M && o.css("overflow-x", "hidden"), r = o.outerHeight(!0))
                } catch (L) {
                }
            } else(x.autoWidth || x.autoHeight) && (w.addClass("fancybox-tmp"), x.autoWidth || w.width(a), x.autoHeight || w.height(r), x.autoWidth && (a = w.width()), x.autoHeight && (r = w.height()), w.removeClass("fancybox-tmp"));
            if (v = h(a), b = h(r), d = a / r, C = h(f(C) ? h(C, "w") - t : C), S = h(f(S) ? h(S, "w") - t : S), T = h(f(T) ? h(T, "h") - i : T), k = h(f(k) ? h(k, "h") - i : k), o = S, l = k, x.fitToView && (S = Math.min(p.w - t, S), k = Math.min(p.h - i, k)), t = p.w - P, D = p.h - D, x.aspectRatio ? (v > S && (v = S, b = h(v / d)), b > k && (b = k, v = h(b * d)), v < C && (v = C, b = h(v / d)), b < T && (b = T, v = h(b * d))) : (v = Math.max(C, Math.min(v, S)), x.autoHeight && "iframe" !== x.type && (w.width(v), b = w.height()), b = Math.max(T, Math.min(b, k))), x.fitToView)if (w.width(v).height(b), g.width(v + z), p = g.width(), P = g.height(), x.aspectRatio)for (; (p > t || P > D) && v > C && b > T && !(19 < u++);)b = Math.max(T, Math.min(k, b - 10)), v = h(b * d), v < C && (v = C, b = h(v / d)), v > S && (v = S, b = h(v / d)), w.width(v).height(b), g.width(v + z), p = g.width(), P = g.height(); else v = Math.max(C, Math.min(v, v - (p - t))), b = Math.max(T, Math.min(b, b - (P - D)));
            M && "auto" === E && b < r && v + z + M < t && (v += M), w.width(v).height(b), g.width(v + z), p = g.width(), P = g.height(), g = (p > t || P > D) && v > C && b > T, v = x.aspectRatio ? v < o && b < l && v < a && b < r : (v < o || b < l) && (v < a || b < r), n.extend(x, {
                dim: {
                    width: m(p),
                    height: m(P)
                },
                origWidth: a,
                origHeight: r,
                canShrink: g,
                canExpand: v,
                wPadding: z,
                hPadding: e,
                wrapSpace: P - y.outerHeight(!0),
                skinSpace: y.height() - b
            }), !c && x.autoHeight && b > T && b < k && !v && w.height("auto")
        },
        _getPosition: function (e) {
            var t = s.current, n = s.getViewport(), i = t.margin, a = s.wrap.width() + i[1] + i[3], r = s.wrap.height() + i[0] + i[2], i = {
                position: "absolute",
                top: i[0],
                left: i[3]
            };
            return t.autoCenter && t.fixed && !e && r <= n.h && a <= n.w ? i.position = "fixed" : t.locked || (i.top += n.y, i.left += n.x), i.top = m(Math.max(i.top, i.top + (n.h - r) * t.topRatio)), i.left = m(Math.max(i.left, i.left + (n.w - a) * t.leftRatio)), i
        },
        _afterZoomIn: function () {
            var e = s.current;
            e && (s.isOpen = s.isOpened = !0, s.wrap.css("overflow", "visible").addClass("fancybox-opened"), s.update(), (e.closeClick || e.nextClick && 1 < s.group.length) && s.inner.css("cursor", "pointer").bind("click.fb", function (t) {
                n(t.target).is("a") || n(t.target).parent().is("a") || (t.preventDefault(), s[e.closeClick ? "close" : "next"]())
            }), e.closeBtn && n(e.tpl.closeBtn).appendTo(s.skin).bind("click.fb", function (e) {
                e.preventDefault(), s.close()
            }), e.arrows && 1 < s.group.length && ((e.loop || 0 < e.index) && n(e.tpl.prev).appendTo(s.outer).bind("click.fb", s.prev), (e.loop || e.index < s.group.length - 1) && n(e.tpl.next).appendTo(s.outer).bind("click.fb", s.next)), s.trigger("afterShow"), e.loop || e.index !== e.group.length - 1 ? s.opts.autoPlay && !s.player.isActive && (s.opts.autoPlay = !1, s.play(!0)) : s.play(!1))
        },
        _afterZoomOut: function (e) {
            e = e || s.current, n(".fancybox-wrap").trigger("onReset").remove(), n.extend(s, {
                group: {},
                opts: {},
                router: !1,
                current: null,
                isActive: !1,
                isOpened: !1,
                isOpen: !1,
                isClosing: !1,
                wrap: null,
                skin: null,
                outer: null,
                inner: null
            }), s.trigger("afterClose", e)
        }
    }), s.transitions = {
        getOrigPosition: function () {
            var e = s.current, t = e.element, n = e.orig, i = {}, a = 50, r = 50, o = e.hPadding, l = e.wPadding, d = s.getViewport();
            return !n && e.isDom && t.is(":visible") && (n = t.find("img:first"), n.length || (n = t)), p(n) ? (i = n.offset(), n.is("img") && (a = n.outerWidth(), r = n.outerHeight())) : (i.top = d.y + (d.h - r) * e.topRatio, i.left = d.x + (d.w - a) * e.leftRatio), ("fixed" === s.wrap.css("position") || e.locked) && (i.top -= d.y, i.left -= d.x), i = {
                top: m(i.top - o * e.topRatio),
                left: m(i.left - l * e.leftRatio),
                width: m(a + l),
                height: m(r + o)
            }
        }, step: function (e, t) {
            var n, i, a = t.prop;
            i = s.current;
            var r = i.wrapSpace, o = i.skinSpace;
            "width" !== a && "height" !== a || (n = t.end === t.start ? 1 : (e - t.start) / (t.end - t.start), s.isClosing && (n = 1 - n), i = "width" === a ? i.wPadding : i.hPadding, i = e - i, s.skin[a](h("width" === a ? i : i - r * n)), s.inner[a](h("width" === a ? i : i - r * n - o * n)))
        }, zoomIn: function () {
            var e = s.current, t = e.pos, i = e.openEffect, a = "elastic" === i, r = n.extend({opacity: 1}, t);
            delete r.position, a ? (t = this.getOrigPosition(), e.openOpacity && (t.opacity = .1)) : "fade" === i && (t.opacity = .1), s.wrap.css(t).animate(r, {
                duration: "none" === i ? 0 : e.openSpeed,
                easing: e.openEasing,
                step: a ? this.step : null,
                complete: s._afterZoomIn
            })
        }, zoomOut: function () {
            var e = s.current, t = e.closeEffect, n = "elastic" === t, i = {opacity: .1};
            n && (i = this.getOrigPosition(), e.closeOpacity && (i.opacity = .1)), s.wrap.animate(i, {
                duration: "none" === t ? 0 : e.closeSpeed,
                easing: e.closeEasing,
                step: n ? this.step : null,
                complete: s._afterZoomOut
            })
        }, changeIn: function () {
            var e, t = s.current, n = t.nextEffect, i = t.pos, a = {opacity: 1}, r = s.direction;
            i.opacity = .1, "elastic" === n && (e = "down" === r || "up" === r ? "top" : "left", "down" === r || "right" === r ? (i[e] = m(h(i[e]) - 200), a[e] = "+=200px") : (i[e] = m(h(i[e]) + 200), a[e] = "-=200px")), "none" === n ? s._afterZoomIn() : s.wrap.css(i).animate(a, {
                duration: t.nextSpeed,
                easing: t.nextEasing,
                complete: s._afterZoomIn
            })
        }, changeOut: function () {
            var e = s.previous, t = e.prevEffect, i = {opacity: .1}, a = s.direction;
            "elastic" === t && (i["down" === a || "up" === a ? "top" : "left"] = ("up" === a || "left" === a ? "-" : "+") + "=200px"), e.wrap.animate(i, {
                duration: "none" === t ? 0 : e.prevSpeed,
                easing: e.prevEasing,
                complete: function () {
                    n(this).trigger("onReset").remove()
                }
            })
        }
    }, s.helpers.overlay = {
        defaults: {closeClick: !0, speedOut: 200, showEarly: !0, css: {}, locked: !c, fixed: !0},
        overlay: null,
        fixed: !1,
        el: n("html"),
        create: function (e) {
            var t;
            e = n.extend({}, this.defaults, e), this.overlay && this.close(), t = s.coming ? s.coming.parent : e.parent, this.overlay = n('<div class="fancybox-overlay"></div>').appendTo(t && t.lenth ? t : "body"), this.fixed = !1, e.fixed && s.defaults.fixed && (this.overlay.addClass("fancybox-overlay-fixed"), this.fixed = !0)
        },
        open: function (e) {
            var t = this;
            e = n.extend({}, this.defaults, e), this.overlay ? this.overlay.unbind(".overlay").width("auto").height("auto") : this.create(e), this.fixed || (r.bind("resize.overlay", n.proxy(this.update, this)), this.update()), e.closeClick && this.overlay.bind("click.overlay", function (e) {
                if (n(e.target).hasClass("fancybox-overlay"))return s.isActive ? s.close() : t.close(), !1
            }), this.overlay.css(e.css).show()
        },
        close: function () {
            r.unbind("resize.overlay"), this.el.hasClass("fancybox-lock") && (n(".fancybox-margin").removeClass("fancybox-margin"), this.el.removeClass("fancybox-lock"), r.scrollTop(this.scrollV).scrollLeft(this.scrollH)), n(".fancybox-overlay").remove().hide(), n.extend(this, {
                overlay: null,
                fixed: !1
            })
        },
        update: function () {
            var e, n = "100%";
            this.overlay.width(n).height("100%"), l ? (e = Math.max(t.documentElement.offsetWidth, t.body.offsetWidth), o.width() > e && (n = o.width())) : o.width() > r.width() && (n = o.width()), this.overlay.width(n).height(o.height())
        },
        onReady: function (e, t) {
            var i = this.overlay;
            n(".fancybox-overlay").stop(!0, !0), i || this.create(e), e.locked && this.fixed && t.fixed && (t.locked = this.overlay.append(t.wrap), t.fixed = !1), !0 === e.showEarly && this.beforeShow.apply(this, arguments)
        },
        beforeShow: function (e, t) {
            t.locked && !this.el.hasClass("fancybox-lock") && (!1 !== this.fixPosition && n("*").filter(function () {
                return "fixed" === n(this).css("position") && !n(this).hasClass("fancybox-overlay") && !n(this).hasClass("fancybox-wrap")
            }).addClass("fancybox-margin"), this.el.addClass("fancybox-margin"), this.scrollV = r.scrollTop(), this.scrollH = r.scrollLeft(), this.el.addClass("fancybox-lock"), r.scrollTop(this.scrollV).scrollLeft(this.scrollH)), this.open(e)
        },
        onUpdate: function () {
            this.fixed || this.update()
        },
        afterClose: function (e) {
            this.overlay && !s.coming && this.overlay.fadeOut(e.speedOut, n.proxy(this.close, this))
        }
    }, s.helpers.title = {
        defaults: {type: "float", position: "bottom"}, beforeShow: function (e) {
            var t = s.current, i = t.title, a = e.type;
            if (n.isFunction(i) && (i = i.call(t.element, t)), u(i) && "" !== n.trim(i)) {
                switch (t = n('<div class="fancybox-title fancybox-title-' + a + '-wrap">' + i + "</div>"), a) {
                    case"inside":
                        a = s.skin;
                        break;
                    case"outside":
                        a = s.wrap;
                        break;
                    case"over":
                        a = s.inner;
                        break;
                    default:
                        a = s.skin, t.appendTo("body"), l && t.width(t.width()), t.wrapInner('<span class="child"></span>'), s.current.margin[2] += Math.abs(h(t.css("margin-bottom")))
                }
                t["top" === e.position ? "prependTo" : "appendTo"](a)
            }
        }
    }, n.fn.fancybox = function (e) {
        var t, i = n(this), a = this.selector || "", r = function (r) {
            var o, l, d = n(this).blur(), c = t;
            r.ctrlKey || r.altKey || r.shiftKey || r.metaKey || d.is(".fancybox-wrap") || (o = e.groupAttr || "data-fancybox-group", l = d.attr(o), l || (o = "rel", l = d.get(0)[o]), l && "" !== l && "nofollow" !== l && (d = a.length ? n(a) : i, d = d.filter("[" + o + '="' + l + '"]'), c = d.index(this)), e.index = c, !1 !== s.open(d, e) && r.preventDefault())
        };
        return e = e || {}, t = e.index || 0, a && !1 !== e.live ? o.undelegate(a, "click.fb-start").delegate(a + ":not('.fancybox-item, .fancybox-nav')", "click.fb-start", r) : i.unbind("click.fb-start").bind("click.fb-start", r), this.filter("[data-fancybox-start=1]").trigger("click"), this
    }, o.ready(function () {
        var t, r;
        n.scrollbarWidth === i && (n.scrollbarWidth = function () {
            var e = n('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"), t = e.children(), t = t.innerWidth() - t.height(99).innerWidth();
            return e.remove(), t
        }), n.support.fixedPosition === i && (n.support.fixedPosition = function () {
            var e = n('<div style="position:fixed;top:20px;"></div>').appendTo("body"), t = 20 === e[0].offsetTop || 15 === e[0].offsetTop;
            return e.remove(), t
        }()), n.extend(s.defaults, {
            scrollbarWidth: n.scrollbarWidth(),
            fixed: n.support.fixedPosition,
            parent: n("body")
        }), t = n(e).width(), a.addClass("fancybox-lock-test"), r = n(e).width(), a.removeClass("fancybox-lock-test"), n("<style type='text/css'>.fancybox-margin{margin-right:" + (r - t) + "px;}</style>").appendTo("head")
    })
}(window, document, jQuery);