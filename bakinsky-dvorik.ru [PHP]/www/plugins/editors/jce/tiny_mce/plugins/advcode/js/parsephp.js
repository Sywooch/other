/*
Copyright (c) 2008-2009 Yahoo! Inc.  All rights reserved.
The copyrights embodied in the content of this file are licensed by
Yahoo! Inc. under the BSD (revised) open source license

@author Vlad Dan Dascalescu <dandv@yahoo-inc.com>
*/
if(!Array.prototype.indexOf)Array.prototype.indexOf=function(w,B){var x=this.length,d=Number(B)||0;d=d<0?Math.ceil(d):Math.floor(d);if(d<0)d+=x;for(;d<x;d++)if(d in this&&this[d]===w)return d;return-1};
var PHPParser=Editor.Parser=function(){function w(d,n,o,b,i,e){this.indented=d;this.column=n;this.type=o;if(b!=null)this.align=b;this.prev=i;this.info=e}function B(d){return function(n){var o=n&&n.charAt(0),b=d.type,i=o==b;return b=="form"&&o=="{"?d.indented:b=="stat"||b=="form"?d.indented+indentUnit:d.info=="switch"&&!i?d.indented+(/^(?:case|default)\b/.test(n)?indentUnit:2*indentUnit):d.align?d.column-(i?1:0):d.indented+(i?0:indentUnit)}}var x={atom:true,number:true,variable:true,string:true};return{make:function(d,
n){function o(a){for(var f=a.length-1;f>=0;f--)p.push(a[f])}function b(){o(arguments);y=true}function i(){o(arguments);y=false}function e(a,f){var k=function(){j=new w(z,u,a,null,j,f)};k.lex=true;return k}function g(){if(j.prev)j=j.prev}function E(a){return function(f){f.type==a?b():b(arguments.callee)}}function c(a,f){return function(k){var l;l=k.type;l=typeof a=="string"?(l==a)-1:a.indexOf(l);if(l>=0)f&&typeof f[l]=="function"?i(f[l]):b();else{if(!r)r=k.style;r+=" syntax-error";b(arguments.callee)}}}
function F(){return i(m,F)}function m(a){a=a.type;if(a=="keyword a")b(e("form"),h,A,m,g);else if(a=="keyword b")b(e("form"),A,m,g);else if(a=="{")b(e("}"),s,g);else if(a=="function")v();else if(a=="class")G();else if(a=="foreach")b(e("form"),c("("),e(")"),h,c("as"),c("variable"),E(")"),A,g,m,g);else if(a=="for")b(e("form"),c("("),e(")"),h,c(";"),h,c(";"),h,c(")"),A,g,m,g);else if(a=="modifier")b(c(["modifier","variable","function","abstract"],[null,t(c("variable")),v,H]));else if(a=="abstract")b(c(["modifier",
"function","class"],[H,v,G]));else if(a=="switch")b(e("form"),c("("),h,c(")"),e("}","switch"),c([":","{"]),s,g,g);else if(a=="case")b(h,c(":"));else if(a=="default")b(c(":"));else if(a=="catch")b(e("form"),c("("),c("t_string"),c("variable"),c(")"),m,g);else if(a=="const")b(c("t_string"));else a=="namespace"?b(I,c(";")):i(e("stat"),h,c(";"),g)}function h(a){a=a.type;if(x.hasOwnProperty(a))b(q);else if(a=="<<<")b(c("string"),q);else if(a=="t_string")b(N,q);else if(a=="keyword c"||a=="operator")b(h);
else if(a=="function")b(c("("),e(")"),t(C),c(")"),O,g,c("{"),e("}"),s,g);else a=="("&&b(e(")"),t(h),c(")"),g,q)}function q(a){var f=a.type;if(f=="operator")a.content=="?"?b(h,c(":"),h):b(h);else if(f=="(")b(e(")"),h,t(h),c(")"),g,q);else f=="["&&b(e("]"),h,c("]"),q,g)}function N(a){a.type=="t_double_colon"?b(c(["t_string","variable"]),q):i(h)}function v(){b(c("t_string"),c("("),e(")"),t(C),c(")"),g,s)}function O(a){a.type=="namespace"?b(c("("),t(C),c(")")):i(h)}function G(){b(c("t_string"),E("{"),
e("}"),s,g)}function H(a){a.type=="function"?v():b(c(["function"],[v]))}function t(a){function f(k){k.type==","&&b(a,f)}return function(){i(a,f)}}function s(a){a.type=="}"?b():i(m,s)}function P(a){a.content=="array"&&b(c("("),c(")"))}function J(a){a.content=="="&&b(c(["t_string","string","number","atom"],[P,null,null]))}function K(a){if(a.type=="variable")b(J);else a.content=="&"&&b(c("variable"),J)}function C(a){a.type=="t_string"?b(K):K(a)}function Q(a){a.type=="t_double_colon"&&b(I)}function I(){i(c("t_string"),
Q)}function A(a){a.content==":"&&b(L,g)}function L(a){a.type=="altsyntaxend"?b(c(";")):i(m,L)}var D=tokenizePHP(d),p=[F],j=new w((n||0)-indentUnit,0,"block",false),u=0,z=0,y,r,M={next:function(){for(;p[p.length-1].lex;)p.pop()();var a=D.next();if(a.type=="whitespace"&&u==0)z=a.value.length;u+=a.value.length;if(a.content=="\n"){z=u=0;if(!("align"in j))j.align=false;a.indentation=B(j)}if(a.type=="whitespace"||a.type=="comment"||a.type=="string_not_terminated")return a;if(!("align"in j))j.align=true;
for(;;){y=r=false;p.pop()(a);if(y){if(r)a.style=r;return a}}return 1},copy:function(){var a=j,f=p.concat([]),k=D.state;return function(l){j=a;p=f.concat([]);u=z=0;D=tokenizePHP(l,k);return M}}};g.lex=true;return M},electricChars:"{}:"}}();