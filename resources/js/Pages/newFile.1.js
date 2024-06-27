import { Head, Link } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';

// export default {
//  components: { Footer },
//   props: {
//     maison: Object
//   }
// }
export default await (async () => {
const { defineProps, defineSlots, defineEmits, defineExpose, defineModel, defineOptions, withDefaults, } = await import('vue');
const props = defineProps({
maison: Object,
user: Object,
nameSeler: Object,
mailSeler: Object,
phoneSeler: Object,
suggestions: Object,
nPiece: Object,
urlActuelle: Object,


canLogin: Boolean,
canRegister: Boolean,
laravelVersion: String,
phpVersion: String,
});

const __VLS_componentsOption = {
Head
};

let __VLS_name!: 'DetailsImmo';
function __VLS_template() {
let __VLS_ctx!: InstanceType<__VLS_PickNotAny<typeof __VLS_internalComponent, new () => {}>> & {};
/* Components */
let __VLS_otherComponents!: NonNullable<typeof __VLS_internalComponent extends { components: infer C; } ? C : {}> & typeof __VLS_componentsOption;
let __VLS_own!: __VLS_SelfComponent<typeof __VLS_name, typeof __VLS_internalComponent & (new () => { $slots: typeof __VLS_slots; })>;
let __VLS_localComponents!: typeof __VLS_otherComponents & Omit<typeof __VLS_own, keyof typeof __VLS_otherComponents>;
let __VLS_components!: typeof __VLS_localComponents & __VLS_GlobalComponents & typeof __VLS_ctx;
/* Style Scoped */
type __VLS_StyleScopedClasses = {};
let __VLS_styleScopedClasses!: __VLS_StyleScopedClasses | keyof __VLS_StyleScopedClasses | (keyof __VLS_StyleScopedClasses)[];
/* CSS variable injection */
/* CSS variable injection end */
let __VLS_resolvedLocalAndGlobalComponents!: {} &
__VLS_WithComponent<'Head', typeof __VLS_localComponents, "Head", "Head", "Head"> &
__VLS_WithComponent<'Link', typeof __VLS_localComponents, "Link", "Link", "Link"> &
__VLS_WithComponent<'Footer', typeof __VLS_localComponents, "Footer", "Footer", "Footer">;
__VLS_components.Head; __VLS_components.Head;
// @ts-ignore
[Head, Head,];
__VLS_intrinsicElements.title; __VLS_intrinsicElements.title;
__VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div;
__VLS_intrinsicElements.nav; __VLS_intrinsicElements.nav;
__VLS_components.Link; __VLS_components.Link; __VLS_components.Link; __VLS_components.Link; __VLS_components.Link; __VLS_components.Link; __VLS_components.Link; __VLS_components.Link; __VLS_components.Link; __VLS_components.Link;
// @ts-ignore
[Link, Link, Link, Link, Link, Link, Link, Link, Link, Link,];
__VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button; __VLS_intrinsicElements.button;
__VLS_intrinsicElements.svg; __VLS_intrinsicElements.svg;
__VLS_intrinsicElements.path; __VLS_intrinsicElements.path;
__VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i; __VLS_intrinsicElements.i;
__VLS_intrinsicElements.main; __VLS_intrinsicElements.main;
__VLS_intrinsicElements.img; __VLS_intrinsicElements.img; __VLS_intrinsicElements.img;
__VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span; __VLS_intrinsicElements.span;
__VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br; __VLS_intrinsicElements.br;
__VLS_intrinsicElements.hr; __VLS_intrinsicElements.hr; __VLS_intrinsicElements.hr; __VLS_intrinsicElements.hr; __VLS_intrinsicElements.hr;
__VLS_intrinsicElements.p; __VLS_intrinsicElements.p;
__VLS_intrinsicElements.h2; __VLS_intrinsicElements.h2;
__VLS_components.Footer;
// @ts-ignore
[Footer,];
{
const __VLS_0 = ({} as 'Head' extends keyof typeof __VLS_ctx ? { 'Head': typeof __VLS_ctx.Head; } : typeof __VLS_resolvedLocalAndGlobalComponents).Head;
const __VLS_1 = __VLS_asFunctionalComponent(__VLS_0, new __VLS_0({ ...{}, }));
({} as { Head: typeof __VLS_0; }).Head;
({} as { Head: typeof __VLS_0; }).Head;
const __VLS_2 = __VLS_1({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_1));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_0, typeof __VLS_2> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_3 = __VLS_pickFunctionalComponentCtx(__VLS_0, __VLS_2)!;
let __VLS_4!: __VLS_NormalizeEmits<typeof __VLS_3.emit>;
{
const __VLS_5 = __VLS_intrinsicElements["title"];
const __VLS_6 = __VLS_elementAsFunctionalComponent(__VLS_5);
const __VLS_7 = __VLS_6({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_6));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_5, typeof __VLS_7> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_8 = __VLS_pickFunctionalComponentCtx(__VLS_5, __VLS_7)!;
let __VLS_9!: __VLS_NormalizeEmits<typeof __VLS_8.emit>;
(__VLS_ctx.maison.nom);
(__VLS_8.slots!).default;
}
(__VLS_3.slots!).default;
}
{
const __VLS_10 = __VLS_intrinsicElements["div"];
const __VLS_11 = __VLS_elementAsFunctionalComponent(__VLS_10);
const __VLS_12 = __VLS_11({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_11));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_10, typeof __VLS_12> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_13 = __VLS_pickFunctionalComponentCtx(__VLS_10, __VLS_12)!;
let __VLS_14!: __VLS_NormalizeEmits<typeof __VLS_13.emit>;
{
const __VLS_15 = __VLS_intrinsicElements["div"];
const __VLS_16 = __VLS_elementAsFunctionalComponent(__VLS_15);
const __VLS_17 = __VLS_16({ ...{}, class: ("nav bg-white w-full m-0 p-0"), }, ...__VLS_functionalComponentArgsRest(__VLS_16));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_15, typeof __VLS_17> & Record<string, unknown>) => void)({ ...{}, class: ("nav bg-white w-full m-0 p-0"), });
const __VLS_18 = __VLS_pickFunctionalComponentCtx(__VLS_15, __VLS_17)!;
let __VLS_19!: __VLS_NormalizeEmits<typeof __VLS_18.emit>;
{
const __VLS_20 = __VLS_intrinsicElements["nav"];
const __VLS_21 = __VLS_elementAsFunctionalComponent(__VLS_20);
const __VLS_22 = __VLS_21({ ...{}, class: ("\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0070\u0078\u002d\u0039\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0070\u0079\u002d\u0032\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u006d\u0078\u002d\u0061\u0075\u0074\u006f\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u006d\u0064\u003a\u0066\u006c\u0065\u0078\u0020\u006d\u0064\u003a\u006a\u0075\u0073\u0074\u0069\u0066\u0079\u002d\u0062\u0065\u0074\u0077\u0065\u0065\u006e\u0020\u006d\u0064\u003a\u0069\u0074\u0065\u006d\u0073\u002d\u0063\u0065\u006e\u0074\u0065\u0072\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0073\u0068\u0061\u0064\u006f\u0077\u002d\u0078\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0072\u0065\u006c\u0061\u0074\u0069\u0076\u0065\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0062\u0067\u002d\u0062\u006c\u0061\u0063\u006b\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0077\u0068\u0069\u0074\u0065\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020"), }, ...__VLS_functionalComponentArgsRest(__VLS_21));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_20, typeof __VLS_22> & Record<string, unknown>) => void)({ ...{}, class: ("\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0070\u0078\u002d\u0039\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0070\u0079\u002d\u0032\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u006d\u0078\u002d\u0061\u0075\u0074\u006f\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u006d\u0064\u003a\u0066\u006c\u0065\u0078\u0020\u006d\u0064\u003a\u006a\u0075\u0073\u0074\u0069\u0066\u0079\u002d\u0062\u0065\u0074\u0077\u0065\u0065\u006e\u0020\u006d\u0064\u003a\u0069\u0074\u0065\u006d\u0073\u002d\u0063\u0065\u006e\u0074\u0065\u0072\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0073\u0068\u0061\u0064\u006f\u0077\u002d\u0078\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0072\u0065\u006c\u0061\u0074\u0069\u0076\u0065\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0062\u0067\u002d\u0062\u006c\u0061\u0063\u006b\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0077\u0068\u0069\u0074\u0065\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020"), });
const __VLS_23 = __VLS_pickFunctionalComponentCtx(__VLS_20, __VLS_22)!;
let __VLS_24!: __VLS_NormalizeEmits<typeof __VLS_23.emit>;
{
const __VLS_25 = __VLS_intrinsicElements["div"];
const __VLS_26 = __VLS_elementAsFunctionalComponent(__VLS_25);
const __VLS_27 = __VLS_26({ ...{}, class: ("flex items-center justify-between "), }, ...__VLS_functionalComponentArgsRest(__VLS_26));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_25, typeof __VLS_27> & Record<string, unknown>) => void)({ ...{}, class: ("flex items-center justify-between "), });
const __VLS_28 = __VLS_pickFunctionalComponentCtx(__VLS_25, __VLS_27)!;
let __VLS_29!: __VLS_NormalizeEmits<typeof __VLS_28.emit>;
{
const __VLS_30 = ({} as 'Link' extends keyof typeof __VLS_ctx ? { 'Link': typeof __VLS_ctx.Link; } : typeof __VLS_resolvedLocalAndGlobalComponents).Link;
const __VLS_31 = __VLS_asFunctionalComponent(__VLS_30, new __VLS_30({ ...{}, href: ((__VLS_ctx.route('home'))), class: ("\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0077\u002d\u0066\u0075\u006c\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0033\u0078\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0038\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0066\u006f\u006e\u0074\u002d\u0062\u006f\u006c\u0064\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u006d\u0064\u003a\u0074\u0065\u0078\u0074\u002d\u0032\u0078\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0070\u0072\u0069\u006e\u0063\u0069\u0070\u0061\u006c\u000a\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020"), }));
({} as { Link: typeof __VLS_30; }).Link;
({} as { Link: typeof __VLS_30; }).Link;
const __VLS_32 = __VLS_31({ ...{}, href: ((__VLS_ctx.route('home'))), class: ("\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0077\u002d\u0066\u0075\u006c\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0033\u0078\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0038\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0066\u006f\u006e\u0074\u002d\u0062\u006f\u006c\u0064\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u006d\u0064\u003a\u0074\u0065\u0078\u0074\u002d\u0032\u0078\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0070\u0072\u0069\u006e\u0063\u0069\u0070\u0061\u006c\u000a\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020"), }, ...__VLS_functionalComponentArgsRest(__VLS_31));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_30, typeof __VLS_32> & Record<string, unknown>) => void)({ ...{}, href: ((__VLS_ctx.route('home'))), class: ("\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0077\u002d\u0066\u0075\u006c\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0033\u0078\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0038\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0066\u006f\u006e\u0074\u002d\u0062\u006f\u006c\u0064\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u006d\u0064\u003a\u0074\u0065\u0078\u0074\u002d\u0032\u0078\u006c\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0070\u0072\u0069\u006e\u0063\u0069\u0070\u0061\u006c\u000a\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020"), });
const __VLS_33 = __VLS_pickFunctionalComponentCtx(__VLS_30, __VLS_32)!;
let __VLS_34!: __VLS_NormalizeEmits<typeof __VLS_33.emit>;
(__VLS_33.slots!).default;
}
{
const __VLS_35 = __VLS_intrinsicElements["div"];
const __VLS_36 = __VLS_elementAsFunctionalComponent(__VLS_35);
const __VLS_37 = __VLS_36({ ...{ onClick: {} as any, }, class: ("flex md:hidden"), }, ...__VLS_functionalComponentArgsRest(__VLS_36));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_35, typeof __VLS_37> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("flex md:hidden"), });
const __VLS_38 = __VLS_pickFunctionalComponentCtx(__VLS_35, __VLS_37)!;
let __VLS_39!: __VLS_NormalizeEmits<typeof __VLS_38.emit>;
let __VLS_40 = { 'click': __VLS_pickEvent(__VLS_39['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_36, typeof __VLS_37>).onClick) };
__VLS_40 = {
click: $event => {
__VLS_ctx.showMenu = !__VLS_ctx.showMenu;
// @ts-ignore
[maison, route, route, route, showMenu, showMenu,];
}
};
{
const __VLS_41 = __VLS_intrinsicElements["button"];
const __VLS_42 = __VLS_elementAsFunctionalComponent(__VLS_41);
const __VLS_43 = __VLS_42({ ...{}, type: ("button"), class: ("\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0067\u0072\u0061\u0079\u002d\u0038\u0030\u0030\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0068\u006f\u0076\u0065\u0072\u003a\u0074\u0065\u0078\u0074\u002d\u0067\u0072\u0061\u0079\u002d\u0034\u0030\u0030\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0066\u006f\u0063\u0075\u0073\u003a\u006f\u0075\u0074\u006c\u0069\u006e\u0065\u002d\u006e\u006f\u006e\u0065\u0020\u0066\u006f\u0063\u0075\u0073\u003a\u0074\u0065\u0078\u0074\u002d\u0067\u0072\u0061\u0079\u002d\u0034\u0030\u0030\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020"), }, ...__VLS_functionalComponentArgsRest(__VLS_42));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_41, typeof __VLS_43> & Record<string, unknown>) => void)({ ...{}, type: ("button"), class: ("\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0074\u0065\u0078\u0074\u002d\u0067\u0072\u0061\u0079\u002d\u0038\u0030\u0030\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0068\u006f\u0076\u0065\u0072\u003a\u0074\u0065\u0078\u0074\u002d\u0067\u0072\u0061\u0079\u002d\u0034\u0030\u0030\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0066\u006f\u0063\u0075\u0073\u003a\u006f\u0075\u0074\u006c\u0069\u006e\u0065\u002d\u006e\u006f\u006e\u0065\u0020\u0066\u006f\u0063\u0075\u0073\u003a\u0074\u0065\u0078\u0074\u002d\u0067\u0072\u0061\u0079\u002d\u0034\u0030\u0030\u000a\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020\u0020"), });
const __VLS_44 = __VLS_pickFunctionalComponentCtx(__VLS_41, __VLS_43)!;
let __VLS_45!: __VLS_NormalizeEmits<typeof __VLS_44.emit>;
{
const __VLS_46 = __VLS_intrinsicElements["svg"];
const __VLS_47 = __VLS_elementAsFunctionalComponent(__VLS_46);
const __VLS_48 = __VLS_47({ ...{}, viewBox: ("0 0 24 24"), class: ("w-6 h-6 fill-current"), }, ...__VLS_functionalComponentArgsRest(__VLS_47));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_46, typeof __VLS_48> & Record<string, unknown>) => void)({ ...{}, viewBox: ("0 0 24 24"), class: ("w-6 h-6 fill-current"), });
const __VLS_49 = __VLS_pickFunctionalComponentCtx(__VLS_46, __VLS_48)!;
let __VLS_50!: __VLS_NormalizeEmits<typeof __VLS_49.emit>;
{
const __VLS_51 = __VLS_intrinsicElements["path"];
const __VLS_52 = __VLS_elementAsFunctionalComponent(__VLS_51);
const __VLS_53 = __VLS_52({ ...{}, "fill-rule": ("evenodd"), d: ("M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"), }, ...__VLS_functionalComponentArgsRest(__VLS_52));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_51, typeof __VLS_53> & Record<string, unknown>) => void)({ ...{}, "fill-rule": ("evenodd"), d: ("M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"), });
const __VLS_54 = __VLS_pickFunctionalComponentCtx(__VLS_51, __VLS_53)!;
let __VLS_55!: __VLS_NormalizeEmits<typeof __VLS_54.emit>;
}
(__VLS_49.slots!).default;
}
(__VLS_44.slots!).default;
}
(__VLS_38.slots!).default;
}
(__VLS_28.slots!).default;
}
{
const __VLS_56 = __VLS_intrinsicElements["div"];
const __VLS_57 = __VLS_elementAsFunctionalComponent(__VLS_56);
const __VLS_58 = __VLS_57({ ...{}, class: ((__VLS_ctx.showMenu ? 'flex' : 'hidden')), }, ...__VLS_functionalComponentArgsRest(__VLS_57));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_56, typeof __VLS_58> & Record<string, unknown>) => void)({ ...{}, class: ((__VLS_ctx.showMenu ? 'flex' : 'hidden')), });
const __VLS_59 = __VLS_pickFunctionalComponentCtx(__VLS_56, __VLS_58)!;
let __VLS_60!: __VLS_NormalizeEmits<typeof __VLS_59.emit>;
{
const __VLS_61 = __VLS_intrinsicElements["div"];
const __VLS_62 = __VLS_elementAsFunctionalComponent(__VLS_61);
const __VLS_63 = __VLS_62({ ...{}, class: ("auth"), }, ...__VLS_functionalComponentArgsRest(__VLS_62));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_61, typeof __VLS_63> & Record<string, unknown>) => void)({ ...{}, class: ("auth"), });
const __VLS_64 = __VLS_pickFunctionalComponentCtx(__VLS_61, __VLS_63)!;
let __VLS_65!: __VLS_NormalizeEmits<typeof __VLS_64.emit>;
if (__VLS_ctx.canLogin) {
{
const __VLS_66 = __VLS_intrinsicElements["div"];
const __VLS_67 = __VLS_elementAsFunctionalComponent(__VLS_66);
const __VLS_68 = __VLS_67({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_67));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_66, typeof __VLS_68> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_69 = __VLS_pickFunctionalComponentCtx(__VLS_66, __VLS_68)!;
let __VLS_70!: __VLS_NormalizeEmits<typeof __VLS_69.emit>;
if (__VLS_ctx.$page.props.auth.user) {
{
const __VLS_71 = ({} as 'Link' extends keyof typeof __VLS_ctx ? { 'Link': typeof __VLS_ctx.Link; } : typeof __VLS_resolvedLocalAndGlobalComponents).Link;
const __VLS_72 = __VLS_asFunctionalComponent(__VLS_71, new __VLS_71({ ...{}, href: ((__VLS_ctx.route('dashboard'))), class: ("font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), }));
({} as { Link: typeof __VLS_71; }).Link;
({} as { Link: typeof __VLS_71; }).Link;
const __VLS_73 = __VLS_72({ ...{}, href: ((__VLS_ctx.route('dashboard'))), class: ("font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), }, ...__VLS_functionalComponentArgsRest(__VLS_72));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_71, typeof __VLS_73> & Record<string, unknown>) => void)({ ...{}, href: ((__VLS_ctx.route('dashboard'))), class: ("font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), });
const __VLS_74 = __VLS_pickFunctionalComponentCtx(__VLS_71, __VLS_73)!;
let __VLS_75!: __VLS_NormalizeEmits<typeof __VLS_74.emit>;
(__VLS_74.slots!).default;
}
// @ts-ignore
[showMenu, showMenu, canLogin, $page, route, route, route,];
}
else {
{
const __VLS_76 = __VLS_intrinsicElements["div"];
const __VLS_77 = __VLS_elementAsFunctionalComponent(__VLS_76);
const __VLS_78 = __VLS_77({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_77));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_76, typeof __VLS_78> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_79 = __VLS_pickFunctionalComponentCtx(__VLS_76, __VLS_78)!;
let __VLS_80!: __VLS_NormalizeEmits<typeof __VLS_79.emit>;
{
const __VLS_81 = __VLS_intrinsicElements["div"];
const __VLS_82 = __VLS_elementAsFunctionalComponent(__VLS_81);
const __VLS_83 = __VLS_82({ ...{}, class: ("auth flex"), }, ...__VLS_functionalComponentArgsRest(__VLS_82));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_81, typeof __VLS_83> & Record<string, unknown>) => void)({ ...{}, class: ("auth flex"), });
const __VLS_84 = __VLS_pickFunctionalComponentCtx(__VLS_81, __VLS_83)!;
let __VLS_85!: __VLS_NormalizeEmits<typeof __VLS_84.emit>;
{
const __VLS_86 = __VLS_intrinsicElements["div"];
const __VLS_87 = __VLS_elementAsFunctionalComponent(__VLS_86);
const __VLS_88 = __VLS_87({ ...{}, class: ("mx-2 bg-principal rounded-xl"), }, ...__VLS_functionalComponentArgsRest(__VLS_87));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_86, typeof __VLS_88> & Record<string, unknown>) => void)({ ...{}, class: ("mx-2 bg-principal rounded-xl"), });
const __VLS_89 = __VLS_pickFunctionalComponentCtx(__VLS_86, __VLS_88)!;
let __VLS_90!: __VLS_NormalizeEmits<typeof __VLS_89.emit>;
{
const __VLS_91 = __VLS_intrinsicElements["i"];
const __VLS_92 = __VLS_elementAsFunctionalComponent(__VLS_91);
const __VLS_93 = __VLS_92({ ...{}, class: ("bi bi-node-plus pl-1"), }, ...__VLS_functionalComponentArgsRest(__VLS_92));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_91, typeof __VLS_93> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-node-plus pl-1"), });
const __VLS_94 = __VLS_pickFunctionalComponentCtx(__VLS_91, __VLS_93)!;
let __VLS_95!: __VLS_NormalizeEmits<typeof __VLS_94.emit>;
}
{
const __VLS_96 = ({} as 'Link' extends keyof typeof __VLS_ctx ? { 'Link': typeof __VLS_ctx.Link; } : typeof __VLS_resolvedLocalAndGlobalComponents).Link;
const __VLS_97 = __VLS_asFunctionalComponent(__VLS_96, new __VLS_96({ ...{}, href: ((__VLS_ctx.route('publier'))), class: (" px-2 py-0 text-white hover:text-gray-900  dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), }));
({} as { Link: typeof __VLS_96; }).Link;
({} as { Link: typeof __VLS_96; }).Link;
const __VLS_98 = __VLS_97({ ...{}, href: ((__VLS_ctx.route('publier'))), class: (" px-2 py-0 text-white hover:text-gray-900  dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), }, ...__VLS_functionalComponentArgsRest(__VLS_97));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_96, typeof __VLS_98> & Record<string, unknown>) => void)({ ...{}, href: ((__VLS_ctx.route('publier'))), class: (" px-2 py-0 text-white hover:text-gray-900  dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), });
const __VLS_99 = __VLS_pickFunctionalComponentCtx(__VLS_96, __VLS_98)!;
let __VLS_100!: __VLS_NormalizeEmits<typeof __VLS_99.emit>;
(__VLS_99.slots!).default;
}
(__VLS_89.slots!).default;
}
{
const __VLS_101 = __VLS_intrinsicElements["i"];
const __VLS_102 = __VLS_elementAsFunctionalComponent(__VLS_101);
const __VLS_103 = __VLS_102({ ...{}, class: ("bi bi-person-circle mx-1"), }, ...__VLS_functionalComponentArgsRest(__VLS_102));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_101, typeof __VLS_103> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-person-circle mx-1"), });
const __VLS_104 = __VLS_pickFunctionalComponentCtx(__VLS_101, __VLS_103)!;
let __VLS_105!: __VLS_NormalizeEmits<typeof __VLS_104.emit>;
}
{
const __VLS_106 = ({} as 'Link' extends keyof typeof __VLS_ctx ? { 'Link': typeof __VLS_ctx.Link; } : typeof __VLS_resolvedLocalAndGlobalComponents).Link;
const __VLS_107 = __VLS_asFunctionalComponent(__VLS_106, new __VLS_106({ ...{}, href: ((__VLS_ctx.route('login'))), class: ("font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), }));
({} as { Link: typeof __VLS_106; }).Link;
({} as { Link: typeof __VLS_106; }).Link;
const __VLS_108 = __VLS_107({ ...{}, href: ((__VLS_ctx.route('login'))), class: ("font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), }, ...__VLS_functionalComponentArgsRest(__VLS_107));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_106, typeof __VLS_108> & Record<string, unknown>) => void)({ ...{}, href: ((__VLS_ctx.route('login'))), class: ("font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), });
const __VLS_109 = __VLS_pickFunctionalComponentCtx(__VLS_106, __VLS_108)!;
let __VLS_110!: __VLS_NormalizeEmits<typeof __VLS_109.emit>;
(__VLS_109.slots!).default;
}
if (__VLS_ctx.canRegister) {
{
const __VLS_111 = ({} as 'Link' extends keyof typeof __VLS_ctx ? { 'Link': typeof __VLS_ctx.Link; } : typeof __VLS_resolvedLocalAndGlobalComponents).Link;
const __VLS_112 = __VLS_asFunctionalComponent(__VLS_111, new __VLS_111({ ...{}, href: ((__VLS_ctx.route('register'))), class: ("ml-4 font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), }));
({} as { Link: typeof __VLS_111; }).Link;
({} as { Link: typeof __VLS_111; }).Link;
const __VLS_113 = __VLS_112({ ...{}, href: ((__VLS_ctx.route('register'))), class: ("ml-4 font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), }, ...__VLS_functionalComponentArgsRest(__VLS_112));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_111, typeof __VLS_113> & Record<string, unknown>) => void)({ ...{}, href: ((__VLS_ctx.route('register'))), class: ("ml-4 font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"), });
const __VLS_114 = __VLS_pickFunctionalComponentCtx(__VLS_111, __VLS_113)!;
let __VLS_115!: __VLS_NormalizeEmits<typeof __VLS_114.emit>;
(__VLS_114.slots!).default;
}
// @ts-ignore
[route, route, route, route, route, route, canRegister, route, route, route,];
}
(__VLS_84.slots!).default;
}
(__VLS_79.slots!).default;
}
}
(__VLS_69.slots!).default;
}
}
(__VLS_64.slots!).default;
}
(__VLS_59.slots!).default;
}
(__VLS_23.slots!).default;
}
(__VLS_18.slots!).default;
}
{
const __VLS_116 = __VLS_intrinsicElements["main"];
const __VLS_117 = __VLS_elementAsFunctionalComponent(__VLS_116);
const __VLS_118 = __VLS_117({ ...{}, class: (" my-6 lg:pl-[10%] flex justify-center"), }, ...__VLS_functionalComponentArgsRest(__VLS_117));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_116, typeof __VLS_118> & Record<string, unknown>) => void)({ ...{}, class: (" my-6 lg:pl-[10%] flex justify-center"), });
const __VLS_119 = __VLS_pickFunctionalComponentCtx(__VLS_116, __VLS_118)!;
let __VLS_120!: __VLS_NormalizeEmits<typeof __VLS_119.emit>;
{
const __VLS_121 = __VLS_intrinsicElements["div"];
const __VLS_122 = __VLS_elementAsFunctionalComponent(__VLS_121);
const __VLS_123 = __VLS_122({ ...{}, class: ("container mx-auto "), }, ...__VLS_functionalComponentArgsRest(__VLS_122));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_121, typeof __VLS_123> & Record<string, unknown>) => void)({ ...{}, class: ("container mx-auto "), });
const __VLS_124 = __VLS_pickFunctionalComponentCtx(__VLS_121, __VLS_123)!;
let __VLS_125!: __VLS_NormalizeEmits<typeof __VLS_124.emit>;
{
const __VLS_126 = __VLS_intrinsicElements["div"];
const __VLS_127 = __VLS_elementAsFunctionalComponent(__VLS_126);
const __VLS_128 = __VLS_127({ ...{}, class: ("md:flex md:items-center"), }, ...__VLS_functionalComponentArgsRest(__VLS_127));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_126, typeof __VLS_128> & Record<string, unknown>) => void)({ ...{}, class: ("md:flex md:items-center"), });
const __VLS_129 = __VLS_pickFunctionalComponentCtx(__VLS_126, __VLS_128)!;
let __VLS_130!: __VLS_NormalizeEmits<typeof __VLS_129.emit>;
{
const __VLS_131 = __VLS_intrinsicElements["div"];
const __VLS_132 = __VLS_elementAsFunctionalComponent(__VLS_131);
const __VLS_133 = __VLS_132({ ...{}, class: (" rounded-sm sm:w-[40rem] sm:h-[22rem] sm:flex items-center sm:justify-center sm:bg-gray-200 relative my-0 sm:mx-0 bg-gray-300"), }, ...__VLS_functionalComponentArgsRest(__VLS_132));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_131, typeof __VLS_133> & Record<string, unknown>) => void)({ ...{}, class: (" rounded-sm sm:w-[40rem] sm:h-[22rem] sm:flex items-center sm:justify-center sm:bg-gray-200 relative my-0 sm:mx-0 bg-gray-300"), });
const __VLS_134 = __VLS_pickFunctionalComponentCtx(__VLS_131, __VLS_133)!;
let __VLS_135!: __VLS_NormalizeEmits<typeof __VLS_134.emit>;
{
const __VLS_136 = __VLS_intrinsicElements["i"];
const __VLS_137 = __VLS_elementAsFunctionalComponent(__VLS_136);
const __VLS_138 = __VLS_137({ ...{ onClick: {} as any, }, class: ("p-2 bg-gray-400 text-3xl rounded text-gray-900 bi bi-chevron-left absolute top-1/2 left-11"), }, ...__VLS_functionalComponentArgsRest(__VLS_137));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_136, typeof __VLS_138> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("p-2 bg-gray-400 text-3xl rounded text-gray-900 bi bi-chevron-left absolute top-1/2 left-11"), });
const __VLS_139 = __VLS_pickFunctionalComponentCtx(__VLS_136, __VLS_138)!;
let __VLS_140!: __VLS_NormalizeEmits<typeof __VLS_139.emit>;
let __VLS_141 = { 'click': __VLS_pickEvent(__VLS_140['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_137, typeof __VLS_138>).onClick) };
__VLS_141 = { click: (__VLS_ctx.previousImage) };
}
{
const __VLS_142 = __VLS_intrinsicElements["div"];
const __VLS_143 = __VLS_elementAsFunctionalComponent(__VLS_142);
const __VLS_144 = __VLS_143({ ...{}, class: ("w-full h-full border"), }, ...__VLS_functionalComponentArgsRest(__VLS_143));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_142, typeof __VLS_144> & Record<string, unknown>) => void)({ ...{}, class: ("w-full h-full border"), });
const __VLS_145 = __VLS_pickFunctionalComponentCtx(__VLS_142, __VLS_144)!;
let __VLS_146!: __VLS_NormalizeEmits<typeof __VLS_145.emit>;
{
const __VLS_147 = __VLS_intrinsicElements["img"];
const __VLS_148 = __VLS_elementAsFunctionalComponent(__VLS_147);
const __VLS_149 = __VLS_148({ ...{}, class: ("w-full h-full "), src: (('/storage/' + __VLS_ctx.currentImage)), }, ...__VLS_functionalComponentArgsRest(__VLS_148));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_147, typeof __VLS_149> & Record<string, unknown>) => void)({ ...{}, class: ("w-full h-full "), src: (('/storage/' + __VLS_ctx.currentImage)), });
const __VLS_150 = __VLS_pickFunctionalComponentCtx(__VLS_147, __VLS_149)!;
let __VLS_151!: __VLS_NormalizeEmits<typeof __VLS_150.emit>;
}
(__VLS_145.slots!).default;
}
{
const __VLS_152 = __VLS_intrinsicElements["i"];
const __VLS_153 = __VLS_elementAsFunctionalComponent(__VLS_152);
const __VLS_154 = __VLS_153({ ...{ onClick: {} as any, }, class: ("p-2 text-4xl bg-gray-400 text-gray-900 rounded bi bi-chevron-right absolute top-1/2 right-11"), }, ...__VLS_functionalComponentArgsRest(__VLS_153));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_152, typeof __VLS_154> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("p-2 text-4xl bg-gray-400 text-gray-900 rounded bi bi-chevron-right absolute top-1/2 right-11"), });
const __VLS_155 = __VLS_pickFunctionalComponentCtx(__VLS_152, __VLS_154)!;
let __VLS_156!: __VLS_NormalizeEmits<typeof __VLS_155.emit>;
let __VLS_157 = { 'click': __VLS_pickEvent(__VLS_156['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_153, typeof __VLS_154>).onClick) };
__VLS_157 = { click: (__VLS_ctx.nextImage) };
}
(__VLS_134.slots!).default;
}
{
const __VLS_158 = __VLS_intrinsicElements["div"];
const __VLS_159 = __VLS_elementAsFunctionalComponent(__VLS_158);
const __VLS_160 = __VLS_159({ ...{}, class: (" max-w-lg sm:mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 mx-auto w-11/12 rounded-2xl md:bg-secondaire p-8 mx-0"), }, ...__VLS_functionalComponentArgsRest(__VLS_159));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_158, typeof __VLS_160> & Record<string, unknown>) => void)({ ...{}, class: (" max-w-lg sm:mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 mx-auto w-11/12 rounded-2xl md:bg-secondaire p-8 mx-0"), });
const __VLS_161 = __VLS_pickFunctionalComponentCtx(__VLS_158, __VLS_160)!;
let __VLS_162!: __VLS_NormalizeEmits<typeof __VLS_161.emit>;
{
const __VLS_163 = __VLS_intrinsicElements["div"];
const __VLS_164 = __VLS_elementAsFunctionalComponent(__VLS_163);
const __VLS_165 = __VLS_164({ ...{}, class: ("head flex"), }, ...__VLS_functionalComponentArgsRest(__VLS_164));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_163, typeof __VLS_165> & Record<string, unknown>) => void)({ ...{}, class: ("head flex"), });
const __VLS_166 = __VLS_pickFunctionalComponentCtx(__VLS_163, __VLS_165)!;
let __VLS_167!: __VLS_NormalizeEmits<typeof __VLS_166.emit>;
{
const __VLS_168 = __VLS_intrinsicElements["img"];
const __VLS_169 = __VLS_elementAsFunctionalComponent(__VLS_168);
const __VLS_170 = __VLS_169({ ...{}, class: ("mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl  bottom-1/3 right-0"), src: ("https://flowbite.com/docs/images/people/profile-picture-3.jpg"), alt: ("Bonnie image"), }, ...__VLS_functionalComponentArgsRest(__VLS_169));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_168, typeof __VLS_170> & Record<string, unknown>) => void)({ ...{}, class: ("mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl  bottom-1/3 right-0"), src: ("https://flowbite.com/docs/images/people/profile-picture-3.jpg"), alt: ("Bonnie image"), });
const __VLS_171 = __VLS_pickFunctionalComponentCtx(__VLS_168, __VLS_170)!;
let __VLS_172!: __VLS_NormalizeEmits<typeof __VLS_171.emit>;
}
{
const __VLS_173 = __VLS_intrinsicElements["span"];
const __VLS_174 = __VLS_elementAsFunctionalComponent(__VLS_173);
const __VLS_175 = __VLS_174({ ...{}, class: ("text-gray-400 mt-3 px-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_174));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_173, typeof __VLS_175> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-400 mt-3 px-3"), });
const __VLS_176 = __VLS_pickFunctionalComponentCtx(__VLS_173, __VLS_175)!;
let __VLS_177!: __VLS_NormalizeEmits<typeof __VLS_176.emit>;
{
const __VLS_178 = __VLS_intrinsicElements["span"];
const __VLS_179 = __VLS_elementAsFunctionalComponent(__VLS_178);
const __VLS_180 = __VLS_179({ ...{}, class: ("text-gray-300 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_179));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_178, typeof __VLS_180> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-300 uppercase"), });
const __VLS_181 = __VLS_pickFunctionalComponentCtx(__VLS_178, __VLS_180)!;
let __VLS_182!: __VLS_NormalizeEmits<typeof __VLS_181.emit>;
(__VLS_ctx.nameSeler);
(__VLS_ctx.);
(__VLS_181.slots!).default;
}
(__VLS_176.slots!).default;
}
{
const __VLS_183 = __VLS_intrinsicElements["br"];
const __VLS_184 = __VLS_elementAsFunctionalComponent(__VLS_183);
const __VLS_185 = __VLS_184({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_184));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_183, typeof __VLS_185> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_186 = __VLS_pickFunctionalComponentCtx(__VLS_183, __VLS_185)!;
let __VLS_187!: __VLS_NormalizeEmits<typeof __VLS_186.emit>;
}
{
const __VLS_188 = __VLS_intrinsicElements["div"];
const __VLS_189 = __VLS_elementAsFunctionalComponent(__VLS_188);
const __VLS_190 = __VLS_189({ ...{}, class: ("bg-white rounded-lg p-8"), }, ...__VLS_functionalComponentArgsRest(__VLS_189));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_188, typeof __VLS_190> & Record<string, unknown>) => void)({ ...{}, class: ("bg-white rounded-lg p-8"), });
const __VLS_191 = __VLS_pickFunctionalComponentCtx(__VLS_188, __VLS_190)!;
let __VLS_192!: __VLS_NormalizeEmits<typeof __VLS_191.emit>;
{
const __VLS_193 = __VLS_intrinsicElements["span"];
const __VLS_194 = __VLS_elementAsFunctionalComponent(__VLS_193);
const __VLS_195 = __VLS_194({ ...{}, class: ("text-3xl text-principal"), }, ...__VLS_functionalComponentArgsRest(__VLS_194));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_193, typeof __VLS_195> & Record<string, unknown>) => void)({ ...{}, class: ("text-3xl text-principal"), });
const __VLS_196 = __VLS_pickFunctionalComponentCtx(__VLS_193, __VLS_195)!;
let __VLS_197!: __VLS_NormalizeEmits<typeof __VLS_196.emit>;
(__VLS_196.slots!).default;
}
{
const __VLS_198 = __VLS_intrinsicElements["br"];
const __VLS_199 = __VLS_elementAsFunctionalComponent(__VLS_198);
const __VLS_200 = __VLS_199({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_199));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_198, typeof __VLS_200> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_201 = __VLS_pickFunctionalComponentCtx(__VLS_198, __VLS_200)!;
let __VLS_202!: __VLS_NormalizeEmits<typeof __VLS_201.emit>;
}
{
const __VLS_203 = __VLS_intrinsicElements["span"];
const __VLS_204 = __VLS_elementAsFunctionalComponent(__VLS_203);
const __VLS_205 = __VLS_204({ ...{}, class: ("text-1xl text-black"), }, ...__VLS_functionalComponentArgsRest(__VLS_204));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_203, typeof __VLS_205> & Record<string, unknown>) => void)({ ...{}, class: ("text-1xl text-black"), });
const __VLS_206 = __VLS_pickFunctionalComponentCtx(__VLS_203, __VLS_205)!;
let __VLS_207!: __VLS_NormalizeEmits<typeof __VLS_206.emit>;
(__VLS_206.slots!).default;
}
{
const __VLS_208 = __VLS_intrinsicElements["br"];
const __VLS_209 = __VLS_elementAsFunctionalComponent(__VLS_208);
const __VLS_210 = __VLS_209({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_209));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_208, typeof __VLS_210> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_211 = __VLS_pickFunctionalComponentCtx(__VLS_208, __VLS_210)!;
let __VLS_212!: __VLS_NormalizeEmits<typeof __VLS_211.emit>;
}
{
const __VLS_213 = __VLS_intrinsicElements["br"];
const __VLS_214 = __VLS_elementAsFunctionalComponent(__VLS_213);
const __VLS_215 = __VLS_214({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_214));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_213, typeof __VLS_215> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_216 = __VLS_pickFunctionalComponentCtx(__VLS_213, __VLS_215)!;
let __VLS_217!: __VLS_NormalizeEmits<typeof __VLS_216.emit>;
}
{
const __VLS_218 = __VLS_intrinsicElements["hr"];
const __VLS_219 = __VLS_elementAsFunctionalComponent(__VLS_218);
const __VLS_220 = __VLS_219({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_219));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_218, typeof __VLS_220> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_221 = __VLS_pickFunctionalComponentCtx(__VLS_218, __VLS_220)!;
let __VLS_222!: __VLS_NormalizeEmits<typeof __VLS_221.emit>;
}
{
const __VLS_223 = __VLS_intrinsicElements["span"];
const __VLS_224 = __VLS_elementAsFunctionalComponent(__VLS_223);
const __VLS_225 = __VLS_224({ ...{}, class: ("text-1xl text-black"), }, ...__VLS_functionalComponentArgsRest(__VLS_224));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_223, typeof __VLS_225> & Record<string, unknown>) => void)({ ...{}, class: ("text-1xl text-black"), });
const __VLS_226 = __VLS_pickFunctionalComponentCtx(__VLS_223, __VLS_225)!;
let __VLS_227!: __VLS_NormalizeEmits<typeof __VLS_226.emit>;
(__VLS_226.slots!).default;
}
{
const __VLS_228 = __VLS_intrinsicElements["span"];
const __VLS_229 = __VLS_elementAsFunctionalComponent(__VLS_228);
const __VLS_230 = __VLS_229({ ...{}, class: ("text-principal"), }, ...__VLS_functionalComponentArgsRest(__VLS_229));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_228, typeof __VLS_230> & Record<string, unknown>) => void)({ ...{}, class: ("text-principal"), });
const __VLS_231 = __VLS_pickFunctionalComponentCtx(__VLS_228, __VLS_230)!;
let __VLS_232!: __VLS_NormalizeEmits<typeof __VLS_231.emit>;
(__VLS_ctx.phoneSeler
);
(__VLS_231.slots!).default;
}
{
const __VLS_233 = __VLS_intrinsicElements["button"];
const __VLS_234 = __VLS_elementAsFunctionalComponent(__VLS_233);
const __VLS_235 = __VLS_234({ ...{ onClick: {} as any, }, class: ("absolute top-0 right-0 mt-2 mr-2 text-1xl text-gray-600 hover:text-gray-800 focus:outline-none"), }, ...__VLS_functionalComponentArgsRest(__VLS_234));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_233, typeof __VLS_235> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("absolute top-0 right-0 mt-2 mr-2 text-1xl text-gray-600 hover:text-gray-800 focus:outline-none"), });
const __VLS_236 = __VLS_pickFunctionalComponentCtx(__VLS_233, __VLS_235)!;
let __VLS_237!: __VLS_NormalizeEmits<typeof __VLS_236.emit>;
let __VLS_238 = { 'click': __VLS_pickEvent(__VLS_237['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_234, typeof __VLS_235>).onClick) };
__VLS_238 = { click: (__VLS_ctx.fermerPopup) };
(__VLS_236.slots!).default;
}
(__VLS_191.slots!).default;
}
(__VLS_166.slots!).default;
}
(__VLS_161.slots!).default;
}
{
const __VLS_239 = __VLS_intrinsicElements["div"];
const __VLS_240 = __VLS_elementAsFunctionalComponent(__VLS_239);
const __VLS_241 = __VLS_240({ ...{}, class: ("second"), }, ...__VLS_functionalComponentArgsRest(__VLS_240));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_239, typeof __VLS_241> & Record<string, unknown>) => void)({ ...{}, class: ("second"), });
const __VLS_242 = __VLS_pickFunctionalComponentCtx(__VLS_239, __VLS_241)!;
let __VLS_243!: __VLS_NormalizeEmits<typeof __VLS_242.emit>;
{
const __VLS_244 = __VLS_intrinsicElements["button"];
const __VLS_245 = __VLS_elementAsFunctionalComponent(__VLS_244);
const __VLS_246 = __VLS_245({ ...{ onClick: {} as any, }, class: ("flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_245));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_244, typeof __VLS_246> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2"), });
const __VLS_247 = __VLS_pickFunctionalComponentCtx(__VLS_244, __VLS_246)!;
let __VLS_248!: __VLS_NormalizeEmits<typeof __VLS_247.emit>;
let __VLS_249 = { 'click': __VLS_pickEvent(__VLS_248['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_245, typeof __VLS_246>).onClick) };
__VLS_249 = { click: (__VLS_ctx.ouvrirWhatsApp) };
{
const __VLS_250 = __VLS_intrinsicElements["i"];
const __VLS_251 = __VLS_elementAsFunctionalComponent(__VLS_250);
const __VLS_252 = __VLS_251({ ...{}, class: ("bi bi-whatsapp text-3xl mr-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_251));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_250, typeof __VLS_252> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-whatsapp text-3xl mr-2"), });
const __VLS_253 = __VLS_pickFunctionalComponentCtx(__VLS_250, __VLS_252)!;
let __VLS_254!: __VLS_NormalizeEmits<typeof __VLS_253.emit>;
}
(__VLS_247.slots!).default;
}
(__VLS_242.slots!).default;
}
(__VLS_129.slots!).default;
}
{
const __VLS_255 = __VLS_intrinsicElements["hr"];
const __VLS_256 = __VLS_elementAsFunctionalComponent(__VLS_255);
const __VLS_257 = __VLS_256({ ...{}, class: ("my-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_256));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_255, typeof __VLS_257> & Record<string, unknown>) => void)({ ...{}, class: ("my-3"), });
const __VLS_258 = __VLS_pickFunctionalComponentCtx(__VLS_255, __VLS_257)!;
let __VLS_259!: __VLS_NormalizeEmits<typeof __VLS_258.emit>;
}
if (__VLS_ctx.maison.type == 'villa') {
{
const __VLS_260 = __VLS_intrinsicElements["div"];
const __VLS_261 = __VLS_elementAsFunctionalComponent(__VLS_260);
const __VLS_262 = __VLS_261({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_261));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_260, typeof __VLS_262> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_263 = __VLS_pickFunctionalComponentCtx(__VLS_260, __VLS_262)!;
let __VLS_264!: __VLS_NormalizeEmits<typeof __VLS_263.emit>;
{
const __VLS_265 = __VLS_intrinsicElements["span"];
const __VLS_266 = __VLS_elementAsFunctionalComponent(__VLS_265);
const __VLS_267 = __VLS_266({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_266));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_265, typeof __VLS_267> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_268 = __VLS_pickFunctionalComponentCtx(__VLS_265, __VLS_267)!;
let __VLS_269!: __VLS_NormalizeEmits<typeof __VLS_268.emit>;
{
const __VLS_270 = __VLS_intrinsicElements["span"];
const __VLS_271 = __VLS_elementAsFunctionalComponent(__VLS_270);
const __VLS_272 = __VLS_271({ ...{}, class: ("text-gray-700 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_271));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_270, typeof __VLS_272> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 uppercase"), });
const __VLS_273 = __VLS_pickFunctionalComponentCtx(__VLS_270, __VLS_272)!;
let __VLS_274!: __VLS_NormalizeEmits<typeof __VLS_273.emit>;
(__VLS_ctx.maison.region);
(__VLS_273.slots!).default;
}
(__VLS_268.slots!).default;
}
{
const __VLS_275 = __VLS_intrinsicElements["br"];
const __VLS_276 = __VLS_elementAsFunctionalComponent(__VLS_275);
const __VLS_277 = __VLS_276({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_276));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_275, typeof __VLS_277> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_278 = __VLS_pickFunctionalComponentCtx(__VLS_275, __VLS_277)!;
let __VLS_279!: __VLS_NormalizeEmits<typeof __VLS_278.emit>;
}
{
const __VLS_280 = __VLS_intrinsicElements["span"];
const __VLS_281 = __VLS_elementAsFunctionalComponent(__VLS_280);
const __VLS_282 = __VLS_281({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_281));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_280, typeof __VLS_282> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_283 = __VLS_pickFunctionalComponentCtx(__VLS_280, __VLS_282)!;
let __VLS_284!: __VLS_NormalizeEmits<typeof __VLS_283.emit>;
{
const __VLS_285 = __VLS_intrinsicElements["span"];
const __VLS_286 = __VLS_elementAsFunctionalComponent(__VLS_285);
const __VLS_287 = __VLS_286({ ...{}, class: ("text-gray-700 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_286));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_285, typeof __VLS_287> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 uppercase"), });
const __VLS_288 = __VLS_pickFunctionalComponentCtx(__VLS_285, __VLS_287)!;
let __VLS_289!: __VLS_NormalizeEmits<typeof __VLS_288.emit>;
(__VLS_ctx.maison.npiece);
(__VLS_288.slots!).default;
}
(__VLS_283.slots!).default;
}
{
const __VLS_290 = __VLS_intrinsicElements["br"];
const __VLS_291 = __VLS_elementAsFunctionalComponent(__VLS_290);
const __VLS_292 = __VLS_291({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_291));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_290, typeof __VLS_292> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_293 = __VLS_pickFunctionalComponentCtx(__VLS_290, __VLS_292)!;
let __VLS_294!: __VLS_NormalizeEmits<typeof __VLS_293.emit>;
}
{
const __VLS_295 = __VLS_intrinsicElements["span"];
const __VLS_296 = __VLS_elementAsFunctionalComponent(__VLS_295);
const __VLS_297 = __VLS_296({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_296));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_295, typeof __VLS_297> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_298 = __VLS_pickFunctionalComponentCtx(__VLS_295, __VLS_297)!;
let __VLS_299!: __VLS_NormalizeEmits<typeof __VLS_298.emit>;
{
const __VLS_300 = __VLS_intrinsicElements["span"];
const __VLS_301 = __VLS_elementAsFunctionalComponent(__VLS_300);
const __VLS_302 = __VLS_301({ ...{}, class: ("text-gray-700 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_301));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_300, typeof __VLS_302> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 uppercase"), });
const __VLS_303 = __VLS_pickFunctionalComponentCtx(__VLS_300, __VLS_302)!;
let __VLS_304!: __VLS_NormalizeEmits<typeof __VLS_303.emit>;
(__VLS_ctx.maison.type);
(__VLS_303.slots!).default;
}
(__VLS_298.slots!).default;
}
{
const __VLS_305 = __VLS_intrinsicElements["br"];
const __VLS_306 = __VLS_elementAsFunctionalComponent(__VLS_305);
const __VLS_307 = __VLS_306({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_306));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_305, typeof __VLS_307> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_308 = __VLS_pickFunctionalComponentCtx(__VLS_305, __VLS_307)!;
let __VLS_309!: __VLS_NormalizeEmits<typeof __VLS_308.emit>;
}
(__VLS_263.slots!).default;
}
// @ts-ignore
[previousImage, currentImage, currentImage, nextImage, nameSeler, , phoneSeler, fermerPopup, ouvrirWhatsApp, maison, maison, maison, maison,];
}
else if (__VLS_ctx.maison.type == 'appartement') {
{
const __VLS_310 = __VLS_intrinsicElements["div"];
const __VLS_311 = __VLS_elementAsFunctionalComponent(__VLS_310);
const __VLS_312 = __VLS_311({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_311));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_310, typeof __VLS_312> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_313 = __VLS_pickFunctionalComponentCtx(__VLS_310, __VLS_312)!;
let __VLS_314!: __VLS_NormalizeEmits<typeof __VLS_313.emit>;
{
const __VLS_315 = __VLS_intrinsicElements["span"];
const __VLS_316 = __VLS_elementAsFunctionalComponent(__VLS_315);
const __VLS_317 = __VLS_316({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_316));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_315, typeof __VLS_317> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_318 = __VLS_pickFunctionalComponentCtx(__VLS_315, __VLS_317)!;
let __VLS_319!: __VLS_NormalizeEmits<typeof __VLS_318.emit>;
{
const __VLS_320 = __VLS_intrinsicElements["span"];
const __VLS_321 = __VLS_elementAsFunctionalComponent(__VLS_320);
const __VLS_322 = __VLS_321({ ...{}, class: ("text-gray-700 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_321));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_320, typeof __VLS_322> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 uppercase"), });
const __VLS_323 = __VLS_pickFunctionalComponentCtx(__VLS_320, __VLS_322)!;
let __VLS_324!: __VLS_NormalizeEmits<typeof __VLS_323.emit>;
(__VLS_ctx.maison.region);
(__VLS_323.slots!).default;
}
(__VLS_318.slots!).default;
}
{
const __VLS_325 = __VLS_intrinsicElements["br"];
const __VLS_326 = __VLS_elementAsFunctionalComponent(__VLS_325);
const __VLS_327 = __VLS_326({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_326));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_325, typeof __VLS_327> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_328 = __VLS_pickFunctionalComponentCtx(__VLS_325, __VLS_327)!;
let __VLS_329!: __VLS_NormalizeEmits<typeof __VLS_328.emit>;
}
{
const __VLS_330 = __VLS_intrinsicElements["span"];
const __VLS_331 = __VLS_elementAsFunctionalComponent(__VLS_330);
const __VLS_332 = __VLS_331({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_331));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_330, typeof __VLS_332> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_333 = __VLS_pickFunctionalComponentCtx(__VLS_330, __VLS_332)!;
let __VLS_334!: __VLS_NormalizeEmits<typeof __VLS_333.emit>;
{
const __VLS_335 = __VLS_intrinsicElements["span"];
const __VLS_336 = __VLS_elementAsFunctionalComponent(__VLS_335);
const __VLS_337 = __VLS_336({ ...{}, class: ("text-gray-700 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_336));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_335, typeof __VLS_337> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 uppercase"), });
const __VLS_338 = __VLS_pickFunctionalComponentCtx(__VLS_335, __VLS_337)!;
let __VLS_339!: __VLS_NormalizeEmits<typeof __VLS_338.emit>;
(__VLS_ctx.maison.npiece);
(__VLS_338.slots!).default;
}
(__VLS_333.slots!).default;
}
{
const __VLS_340 = __VLS_intrinsicElements["br"];
const __VLS_341 = __VLS_elementAsFunctionalComponent(__VLS_340);
const __VLS_342 = __VLS_341({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_341));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_340, typeof __VLS_342> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_343 = __VLS_pickFunctionalComponentCtx(__VLS_340, __VLS_342)!;
let __VLS_344!: __VLS_NormalizeEmits<typeof __VLS_343.emit>;
}
{
const __VLS_345 = __VLS_intrinsicElements["span"];
const __VLS_346 = __VLS_elementAsFunctionalComponent(__VLS_345);
const __VLS_347 = __VLS_346({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_346));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_345, typeof __VLS_347> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_348 = __VLS_pickFunctionalComponentCtx(__VLS_345, __VLS_347)!;
let __VLS_349!: __VLS_NormalizeEmits<typeof __VLS_348.emit>;
{
const __VLS_350 = __VLS_intrinsicElements["span"];
const __VLS_351 = __VLS_elementAsFunctionalComponent(__VLS_350);
const __VLS_352 = __VLS_351({ ...{}, class: ("text-gray-700 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_351));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_350, typeof __VLS_352> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 uppercase"), });
const __VLS_353 = __VLS_pickFunctionalComponentCtx(__VLS_350, __VLS_352)!;
let __VLS_354!: __VLS_NormalizeEmits<typeof __VLS_353.emit>;
(__VLS_ctx.maison.type);
(__VLS_353.slots!).default;
}
(__VLS_348.slots!).default;
}
{
const __VLS_355 = __VLS_intrinsicElements["br"];
const __VLS_356 = __VLS_elementAsFunctionalComponent(__VLS_355);
const __VLS_357 = __VLS_356({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_356));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_355, typeof __VLS_357> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_358 = __VLS_pickFunctionalComponentCtx(__VLS_355, __VLS_357)!;
let __VLS_359!: __VLS_NormalizeEmits<typeof __VLS_358.emit>;
}
(__VLS_313.slots!).default;
}
// @ts-ignore
[maison, maison, maison, maison,];
}
else if (__VLS_ctx.maison.type == 'chambre') {
{
const __VLS_360 = __VLS_intrinsicElements["div"];
const __VLS_361 = __VLS_elementAsFunctionalComponent(__VLS_360);
const __VLS_362 = __VLS_361({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_361));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_360, typeof __VLS_362> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_363 = __VLS_pickFunctionalComponentCtx(__VLS_360, __VLS_362)!;
let __VLS_364!: __VLS_NormalizeEmits<typeof __VLS_363.emit>;
{
const __VLS_365 = __VLS_intrinsicElements["span"];
const __VLS_366 = __VLS_elementAsFunctionalComponent(__VLS_365);
const __VLS_367 = __VLS_366({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_366));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_365, typeof __VLS_367> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_368 = __VLS_pickFunctionalComponentCtx(__VLS_365, __VLS_367)!;
let __VLS_369!: __VLS_NormalizeEmits<typeof __VLS_368.emit>;
{
const __VLS_370 = __VLS_intrinsicElements["span"];
const __VLS_371 = __VLS_elementAsFunctionalComponent(__VLS_370);
const __VLS_372 = __VLS_371({ ...{}, class: ("text-gray-700 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_371));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_370, typeof __VLS_372> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 uppercase"), });
const __VLS_373 = __VLS_pickFunctionalComponentCtx(__VLS_370, __VLS_372)!;
let __VLS_374!: __VLS_NormalizeEmits<typeof __VLS_373.emit>;
(__VLS_ctx.maison.region);
(__VLS_373.slots!).default;
}
(__VLS_368.slots!).default;
}
{
const __VLS_375 = __VLS_intrinsicElements["br"];
const __VLS_376 = __VLS_elementAsFunctionalComponent(__VLS_375);
const __VLS_377 = __VLS_376({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_376));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_375, typeof __VLS_377> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_378 = __VLS_pickFunctionalComponentCtx(__VLS_375, __VLS_377)!;
let __VLS_379!: __VLS_NormalizeEmits<typeof __VLS_378.emit>;
}
{
const __VLS_380 = __VLS_intrinsicElements["span"];
const __VLS_381 = __VLS_elementAsFunctionalComponent(__VLS_380);
const __VLS_382 = __VLS_381({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_381));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_380, typeof __VLS_382> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_383 = __VLS_pickFunctionalComponentCtx(__VLS_380, __VLS_382)!;
let __VLS_384!: __VLS_NormalizeEmits<typeof __VLS_383.emit>;
{
const __VLS_385 = __VLS_intrinsicElements["span"];
const __VLS_386 = __VLS_elementAsFunctionalComponent(__VLS_385);
const __VLS_387 = __VLS_386({ ...{}, class: ("text-gray-700 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_386));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_385, typeof __VLS_387> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 uppercase"), });
const __VLS_388 = __VLS_pickFunctionalComponentCtx(__VLS_385, __VLS_387)!;
let __VLS_389!: __VLS_NormalizeEmits<typeof __VLS_388.emit>;
(__VLS_ctx.maison.npiece);
(__VLS_388.slots!).default;
}
(__VLS_383.slots!).default;
}
{
const __VLS_390 = __VLS_intrinsicElements["br"];
const __VLS_391 = __VLS_elementAsFunctionalComponent(__VLS_390);
const __VLS_392 = __VLS_391({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_391));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_390, typeof __VLS_392> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_393 = __VLS_pickFunctionalComponentCtx(__VLS_390, __VLS_392)!;
let __VLS_394!: __VLS_NormalizeEmits<typeof __VLS_393.emit>;
}
{
const __VLS_395 = __VLS_intrinsicElements["span"];
const __VLS_396 = __VLS_elementAsFunctionalComponent(__VLS_395);
const __VLS_397 = __VLS_396({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_396));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_395, typeof __VLS_397> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_398 = __VLS_pickFunctionalComponentCtx(__VLS_395, __VLS_397)!;
let __VLS_399!: __VLS_NormalizeEmits<typeof __VLS_398.emit>;
{
const __VLS_400 = __VLS_intrinsicElements["span"];
const __VLS_401 = __VLS_elementAsFunctionalComponent(__VLS_400);
const __VLS_402 = __VLS_401({ ...{}, class: ("text-gray-700 uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_401));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_400, typeof __VLS_402> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 uppercase"), });
const __VLS_403 = __VLS_pickFunctionalComponentCtx(__VLS_400, __VLS_402)!;
let __VLS_404!: __VLS_NormalizeEmits<typeof __VLS_403.emit>;
(__VLS_ctx.maison.type);
(__VLS_403.slots!).default;
}
(__VLS_398.slots!).default;
}
{
const __VLS_405 = __VLS_intrinsicElements["br"];
const __VLS_406 = __VLS_elementAsFunctionalComponent(__VLS_405);
const __VLS_407 = __VLS_406({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_406));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_405, typeof __VLS_407> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_408 = __VLS_pickFunctionalComponentCtx(__VLS_405, __VLS_407)!;
let __VLS_409!: __VLS_NormalizeEmits<typeof __VLS_408.emit>;
}
(__VLS_363.slots!).default;
}
// @ts-ignore
[maison, maison, maison, maison,];
}
else if (__VLS_ctx.maison.type == 'verger') {
{
const __VLS_410 = __VLS_intrinsicElements["div"];
const __VLS_411 = __VLS_elementAsFunctionalComponent(__VLS_410);
const __VLS_412 = __VLS_411({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_411));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_410, typeof __VLS_412> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_413 = __VLS_pickFunctionalComponentCtx(__VLS_410, __VLS_412)!;
let __VLS_414!: __VLS_NormalizeEmits<typeof __VLS_413.emit>;
{
const __VLS_415 = __VLS_intrinsicElements["span"];
const __VLS_416 = __VLS_elementAsFunctionalComponent(__VLS_415);
const __VLS_417 = __VLS_416({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_416));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_415, typeof __VLS_417> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_418 = __VLS_pickFunctionalComponentCtx(__VLS_415, __VLS_417)!;
let __VLS_419!: __VLS_NormalizeEmits<typeof __VLS_418.emit>;
{
const __VLS_420 = __VLS_intrinsicElements["span"];
const __VLS_421 = __VLS_elementAsFunctionalComponent(__VLS_420);
const __VLS_422 = __VLS_421({ ...{}, class: ("text-gray-700 "), }, ...__VLS_functionalComponentArgsRest(__VLS_421));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_420, typeof __VLS_422> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 "), });
const __VLS_423 = __VLS_pickFunctionalComponentCtx(__VLS_420, __VLS_422)!;
let __VLS_424!: __VLS_NormalizeEmits<typeof __VLS_423.emit>;
(__VLS_ctx.maison.region);
(__VLS_423.slots!).default;
}
(__VLS_418.slots!).default;
}
{
const __VLS_425 = __VLS_intrinsicElements["br"];
const __VLS_426 = __VLS_elementAsFunctionalComponent(__VLS_425);
const __VLS_427 = __VLS_426({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_426));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_425, typeof __VLS_427> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_428 = __VLS_pickFunctionalComponentCtx(__VLS_425, __VLS_427)!;
let __VLS_429!: __VLS_NormalizeEmits<typeof __VLS_428.emit>;
}
{
const __VLS_430 = __VLS_intrinsicElements["span"];
const __VLS_431 = __VLS_elementAsFunctionalComponent(__VLS_430);
const __VLS_432 = __VLS_431({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_431));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_430, typeof __VLS_432> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_433 = __VLS_pickFunctionalComponentCtx(__VLS_430, __VLS_432)!;
let __VLS_434!: __VLS_NormalizeEmits<typeof __VLS_433.emit>;
{
const __VLS_435 = __VLS_intrinsicElements["span"];
const __VLS_436 = __VLS_elementAsFunctionalComponent(__VLS_435);
const __VLS_437 = __VLS_436({ ...{}, class: ("text-gray-700 "), }, ...__VLS_functionalComponentArgsRest(__VLS_436));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_435, typeof __VLS_437> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 "), });
const __VLS_438 = __VLS_pickFunctionalComponentCtx(__VLS_435, __VLS_437)!;
let __VLS_439!: __VLS_NormalizeEmits<typeof __VLS_438.emit>;
(__VLS_ctx.maison.surface);
(__VLS_438.slots!).default;
}
(__VLS_433.slots!).default;
}
{
const __VLS_440 = __VLS_intrinsicElements["br"];
const __VLS_441 = __VLS_elementAsFunctionalComponent(__VLS_440);
const __VLS_442 = __VLS_441({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_441));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_440, typeof __VLS_442> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_443 = __VLS_pickFunctionalComponentCtx(__VLS_440, __VLS_442)!;
let __VLS_444!: __VLS_NormalizeEmits<typeof __VLS_443.emit>;
}
{
const __VLS_445 = __VLS_intrinsicElements["span"];
const __VLS_446 = __VLS_elementAsFunctionalComponent(__VLS_445);
const __VLS_447 = __VLS_446({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_446));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_445, typeof __VLS_447> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_448 = __VLS_pickFunctionalComponentCtx(__VLS_445, __VLS_447)!;
let __VLS_449!: __VLS_NormalizeEmits<typeof __VLS_448.emit>;
{
const __VLS_450 = __VLS_intrinsicElements["span"];
const __VLS_451 = __VLS_elementAsFunctionalComponent(__VLS_450);
const __VLS_452 = __VLS_451({ ...{}, class: ("text-gray-700 "), }, ...__VLS_functionalComponentArgsRest(__VLS_451));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_450, typeof __VLS_452> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 "), });
const __VLS_453 = __VLS_pickFunctionalComponentCtx(__VLS_450, __VLS_452)!;
let __VLS_454!: __VLS_NormalizeEmits<typeof __VLS_453.emit>;
(__VLS_ctx.maison.type);
(__VLS_453.slots!).default;
}
(__VLS_448.slots!).default;
}
{
const __VLS_455 = __VLS_intrinsicElements["br"];
const __VLS_456 = __VLS_elementAsFunctionalComponent(__VLS_455);
const __VLS_457 = __VLS_456({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_456));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_455, typeof __VLS_457> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_458 = __VLS_pickFunctionalComponentCtx(__VLS_455, __VLS_457)!;
let __VLS_459!: __VLS_NormalizeEmits<typeof __VLS_458.emit>;
}
(__VLS_413.slots!).default;
}
// @ts-ignore
[maison, maison, maison, maison,];
}
else if (__VLS_ctx.maison.type == 'ferme') {
{
const __VLS_460 = __VLS_intrinsicElements["div"];
const __VLS_461 = __VLS_elementAsFunctionalComponent(__VLS_460);
const __VLS_462 = __VLS_461({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_461));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_460, typeof __VLS_462> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_463 = __VLS_pickFunctionalComponentCtx(__VLS_460, __VLS_462)!;
let __VLS_464!: __VLS_NormalizeEmits<typeof __VLS_463.emit>;
{
const __VLS_465 = __VLS_intrinsicElements["span"];
const __VLS_466 = __VLS_elementAsFunctionalComponent(__VLS_465);
const __VLS_467 = __VLS_466({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_466));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_465, typeof __VLS_467> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_468 = __VLS_pickFunctionalComponentCtx(__VLS_465, __VLS_467)!;
let __VLS_469!: __VLS_NormalizeEmits<typeof __VLS_468.emit>;
{
const __VLS_470 = __VLS_intrinsicElements["span"];
const __VLS_471 = __VLS_elementAsFunctionalComponent(__VLS_470);
const __VLS_472 = __VLS_471({ ...{}, class: ("text-gray-700 "), }, ...__VLS_functionalComponentArgsRest(__VLS_471));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_470, typeof __VLS_472> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 "), });
const __VLS_473 = __VLS_pickFunctionalComponentCtx(__VLS_470, __VLS_472)!;
let __VLS_474!: __VLS_NormalizeEmits<typeof __VLS_473.emit>;
(__VLS_ctx.maison.region);
(__VLS_473.slots!).default;
}
(__VLS_468.slots!).default;
}
{
const __VLS_475 = __VLS_intrinsicElements["br"];
const __VLS_476 = __VLS_elementAsFunctionalComponent(__VLS_475);
const __VLS_477 = __VLS_476({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_476));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_475, typeof __VLS_477> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_478 = __VLS_pickFunctionalComponentCtx(__VLS_475, __VLS_477)!;
let __VLS_479!: __VLS_NormalizeEmits<typeof __VLS_478.emit>;
}
{
const __VLS_480 = __VLS_intrinsicElements["span"];
const __VLS_481 = __VLS_elementAsFunctionalComponent(__VLS_480);
const __VLS_482 = __VLS_481({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_481));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_480, typeof __VLS_482> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_483 = __VLS_pickFunctionalComponentCtx(__VLS_480, __VLS_482)!;
let __VLS_484!: __VLS_NormalizeEmits<typeof __VLS_483.emit>;
{
const __VLS_485 = __VLS_intrinsicElements["span"];
const __VLS_486 = __VLS_elementAsFunctionalComponent(__VLS_485);
const __VLS_487 = __VLS_486({ ...{}, class: ("text-gray-700 "), }, ...__VLS_functionalComponentArgsRest(__VLS_486));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_485, typeof __VLS_487> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 "), });
const __VLS_488 = __VLS_pickFunctionalComponentCtx(__VLS_485, __VLS_487)!;
let __VLS_489!: __VLS_NormalizeEmits<typeof __VLS_488.emit>;
(__VLS_ctx.maison.surface);
(__VLS_488.slots!).default;
}
(__VLS_483.slots!).default;
}
{
const __VLS_490 = __VLS_intrinsicElements["br"];
const __VLS_491 = __VLS_elementAsFunctionalComponent(__VLS_490);
const __VLS_492 = __VLS_491({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_491));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_490, typeof __VLS_492> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_493 = __VLS_pickFunctionalComponentCtx(__VLS_490, __VLS_492)!;
let __VLS_494!: __VLS_NormalizeEmits<typeof __VLS_493.emit>;
}
{
const __VLS_495 = __VLS_intrinsicElements["span"];
const __VLS_496 = __VLS_elementAsFunctionalComponent(__VLS_495);
const __VLS_497 = __VLS_496({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_496));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_495, typeof __VLS_497> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_498 = __VLS_pickFunctionalComponentCtx(__VLS_495, __VLS_497)!;
let __VLS_499!: __VLS_NormalizeEmits<typeof __VLS_498.emit>;
{
const __VLS_500 = __VLS_intrinsicElements["span"];
const __VLS_501 = __VLS_elementAsFunctionalComponent(__VLS_500);
const __VLS_502 = __VLS_501({ ...{}, class: ("text-gray-700 "), }, ...__VLS_functionalComponentArgsRest(__VLS_501));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_500, typeof __VLS_502> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 "), });
const __VLS_503 = __VLS_pickFunctionalComponentCtx(__VLS_500, __VLS_502)!;
let __VLS_504!: __VLS_NormalizeEmits<typeof __VLS_503.emit>;
(__VLS_ctx.maison.type);
(__VLS_503.slots!).default;
}
(__VLS_498.slots!).default;
}
{
const __VLS_505 = __VLS_intrinsicElements["br"];
const __VLS_506 = __VLS_elementAsFunctionalComponent(__VLS_505);
const __VLS_507 = __VLS_506({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_506));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_505, typeof __VLS_507> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_508 = __VLS_pickFunctionalComponentCtx(__VLS_505, __VLS_507)!;
let __VLS_509!: __VLS_NormalizeEmits<typeof __VLS_508.emit>;
}
(__VLS_463.slots!).default;
}
// @ts-ignore
[maison, maison, maison, maison,];
}
else if (__VLS_ctx.maison.type == 'terrain') {
{
const __VLS_510 = __VLS_intrinsicElements["div"];
const __VLS_511 = __VLS_elementAsFunctionalComponent(__VLS_510);
const __VLS_512 = __VLS_511({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_511));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_510, typeof __VLS_512> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_513 = __VLS_pickFunctionalComponentCtx(__VLS_510, __VLS_512)!;
let __VLS_514!: __VLS_NormalizeEmits<typeof __VLS_513.emit>;
{
const __VLS_515 = __VLS_intrinsicElements["span"];
const __VLS_516 = __VLS_elementAsFunctionalComponent(__VLS_515);
const __VLS_517 = __VLS_516({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_516));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_515, typeof __VLS_517> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_518 = __VLS_pickFunctionalComponentCtx(__VLS_515, __VLS_517)!;
let __VLS_519!: __VLS_NormalizeEmits<typeof __VLS_518.emit>;
{
const __VLS_520 = __VLS_intrinsicElements["span"];
const __VLS_521 = __VLS_elementAsFunctionalComponent(__VLS_520);
const __VLS_522 = __VLS_521({ ...{}, class: ("text-gray-700 "), }, ...__VLS_functionalComponentArgsRest(__VLS_521));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_520, typeof __VLS_522> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 "), });
const __VLS_523 = __VLS_pickFunctionalComponentCtx(__VLS_520, __VLS_522)!;
let __VLS_524!: __VLS_NormalizeEmits<typeof __VLS_523.emit>;
(__VLS_ctx.maison.region);
(__VLS_523.slots!).default;
}
(__VLS_518.slots!).default;
}
{
const __VLS_525 = __VLS_intrinsicElements["br"];
const __VLS_526 = __VLS_elementAsFunctionalComponent(__VLS_525);
const __VLS_527 = __VLS_526({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_526));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_525, typeof __VLS_527> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_528 = __VLS_pickFunctionalComponentCtx(__VLS_525, __VLS_527)!;
let __VLS_529!: __VLS_NormalizeEmits<typeof __VLS_528.emit>;
}
{
const __VLS_530 = __VLS_intrinsicElements["span"];
const __VLS_531 = __VLS_elementAsFunctionalComponent(__VLS_530);
const __VLS_532 = __VLS_531({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_531));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_530, typeof __VLS_532> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_533 = __VLS_pickFunctionalComponentCtx(__VLS_530, __VLS_532)!;
let __VLS_534!: __VLS_NormalizeEmits<typeof __VLS_533.emit>;
{
const __VLS_535 = __VLS_intrinsicElements["span"];
const __VLS_536 = __VLS_elementAsFunctionalComponent(__VLS_535);
const __VLS_537 = __VLS_536({ ...{}, class: ("text-gray-700 "), }, ...__VLS_functionalComponentArgsRest(__VLS_536));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_535, typeof __VLS_537> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 "), });
const __VLS_538 = __VLS_pickFunctionalComponentCtx(__VLS_535, __VLS_537)!;
let __VLS_539!: __VLS_NormalizeEmits<typeof __VLS_538.emit>;
(__VLS_ctx.maison.surface);
(__VLS_538.slots!).default;
}
(__VLS_533.slots!).default;
}
{
const __VLS_540 = __VLS_intrinsicElements["br"];
const __VLS_541 = __VLS_elementAsFunctionalComponent(__VLS_540);
const __VLS_542 = __VLS_541({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_541));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_540, typeof __VLS_542> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_543 = __VLS_pickFunctionalComponentCtx(__VLS_540, __VLS_542)!;
let __VLS_544!: __VLS_NormalizeEmits<typeof __VLS_543.emit>;
}
{
const __VLS_545 = __VLS_intrinsicElements["span"];
const __VLS_546 = __VLS_elementAsFunctionalComponent(__VLS_545);
const __VLS_547 = __VLS_546({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_546));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_545, typeof __VLS_547> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_548 = __VLS_pickFunctionalComponentCtx(__VLS_545, __VLS_547)!;
let __VLS_549!: __VLS_NormalizeEmits<typeof __VLS_548.emit>;
{
const __VLS_550 = __VLS_intrinsicElements["span"];
const __VLS_551 = __VLS_elementAsFunctionalComponent(__VLS_550);
const __VLS_552 = __VLS_551({ ...{}, class: ("text-gray-700 "), }, ...__VLS_functionalComponentArgsRest(__VLS_551));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_550, typeof __VLS_552> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-700 "), });
const __VLS_553 = __VLS_pickFunctionalComponentCtx(__VLS_550, __VLS_552)!;
let __VLS_554!: __VLS_NormalizeEmits<typeof __VLS_553.emit>;
(__VLS_ctx.maison.type);
(__VLS_553.slots!).default;
}
(__VLS_548.slots!).default;
}
{
const __VLS_555 = __VLS_intrinsicElements["br"];
const __VLS_556 = __VLS_elementAsFunctionalComponent(__VLS_555);
const __VLS_557 = __VLS_556({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_556));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_555, typeof __VLS_557> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_558 = __VLS_pickFunctionalComponentCtx(__VLS_555, __VLS_557)!;
let __VLS_559!: __VLS_NormalizeEmits<typeof __VLS_558.emit>;
}
(__VLS_513.slots!).default;
}
// @ts-ignore
[maison, maison, maison, maison,];
}
{
const __VLS_560 = __VLS_intrinsicElements["div"];
const __VLS_561 = __VLS_elementAsFunctionalComponent(__VLS_560);
const __VLS_562 = __VLS_561({ ...{}, class: ("flex flex-col   hidden md:flex"), }, ...__VLS_functionalComponentArgsRest(__VLS_561));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_560, typeof __VLS_562> & Record<string, unknown>) => void)({ ...{}, class: ("flex flex-col   hidden md:flex"), });
const __VLS_563 = __VLS_pickFunctionalComponentCtx(__VLS_560, __VLS_562)!;
let __VLS_564!: __VLS_NormalizeEmits<typeof __VLS_563.emit>;
{
const __VLS_565 = __VLS_intrinsicElements["button"];
const __VLS_566 = __VLS_elementAsFunctionalComponent(__VLS_565);
const __VLS_567 = __VLS_566({ ...{ onClick: {} as any, }, class: ("w-full h-12 bg-principal text-white font-medium rounded-md mb-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_566));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_565, typeof __VLS_567> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("w-full h-12 bg-principal text-white font-medium rounded-md mb-2"), });
const __VLS_568 = __VLS_pickFunctionalComponentCtx(__VLS_565, __VLS_567)!;
let __VLS_569!: __VLS_NormalizeEmits<typeof __VLS_568.emit>;
let __VLS_570 = { 'click': __VLS_pickEvent(__VLS_569['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_566, typeof __VLS_567>).onClick) };
__VLS_570 = { click: (__VLS_ctx.ouvrirWhatsApp) };
(__VLS_568.slots!).default;
}
{
const __VLS_571 = __VLS_intrinsicElements["div"];
const __VLS_572 = __VLS_elementAsFunctionalComponent(__VLS_571);
const __VLS_573 = __VLS_572({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_572));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_571, typeof __VLS_573> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_574 = __VLS_pickFunctionalComponentCtx(__VLS_571, __VLS_573)!;
let __VLS_575!: __VLS_NormalizeEmits<typeof __VLS_574.emit>;
{
const __VLS_576 = __VLS_intrinsicElements["button"];
const __VLS_577 = __VLS_elementAsFunctionalComponent(__VLS_576);
const __VLS_578 = __VLS_577({ ...{ onClick: {} as any, }, class: ("w-full h-12 border-2 border-principal hover:bg-principal hover:border-1 hover:border-white text-white font-medium rounded-md"), }, ...__VLS_functionalComponentArgsRest(__VLS_577));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_576, typeof __VLS_578> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("w-full h-12 border-2 border-principal hover:bg-principal hover:border-1 hover:border-white text-white font-medium rounded-md"), });
const __VLS_579 = __VLS_pickFunctionalComponentCtx(__VLS_576, __VLS_578)!;
let __VLS_580!: __VLS_NormalizeEmits<typeof __VLS_579.emit>;
let __VLS_581 = { 'click': __VLS_pickEvent(__VLS_580['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_577, typeof __VLS_578>).onClick) };
__VLS_581 = { click: (__VLS_ctx.afficherNumero) };
(__VLS_579.slots!).default;
}
if (__VLS_ctx.afficherPopup) {
{
const __VLS_582 = __VLS_intrinsicElements["div"];
const __VLS_583 = __VLS_elementAsFunctionalComponent(__VLS_582);
const __VLS_584 = __VLS_583({ ...{}, class: ("w-2/4 mx-auto fixed inset-0 flex justify-center bg-gray-800 bg-opacity-75"), }, ...__VLS_functionalComponentArgsRest(__VLS_583));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_582, typeof __VLS_584> & Record<string, unknown>) => void)({ ...{}, class: ("w-2/4 mx-auto fixed inset-0 flex justify-center bg-gray-800 bg-opacity-75"), });
const __VLS_585 = __VLS_pickFunctionalComponentCtx(__VLS_582, __VLS_584)!;
let __VLS_586!: __VLS_NormalizeEmits<typeof __VLS_585.emit>;
{
const __VLS_587 = __VLS_intrinsicElements["div"];
const __VLS_588 = __VLS_elementAsFunctionalComponent(__VLS_587);
const __VLS_589 = __VLS_588({ ...{}, class: ("bg-white rounded-lg p-8"), }, ...__VLS_functionalComponentArgsRest(__VLS_588));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_587, typeof __VLS_589> & Record<string, unknown>) => void)({ ...{}, class: ("bg-white rounded-lg p-8"), });
const __VLS_590 = __VLS_pickFunctionalComponentCtx(__VLS_587, __VLS_589)!;
let __VLS_591!: __VLS_NormalizeEmits<typeof __VLS_590.emit>;
{
const __VLS_592 = __VLS_intrinsicElements["span"];
const __VLS_593 = __VLS_elementAsFunctionalComponent(__VLS_592);
const __VLS_594 = __VLS_593({ ...{}, class: ("text-3xl text-principal"), }, ...__VLS_functionalComponentArgsRest(__VLS_593));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_592, typeof __VLS_594> & Record<string, unknown>) => void)({ ...{}, class: ("text-3xl text-principal"), });
const __VLS_595 = __VLS_pickFunctionalComponentCtx(__VLS_592, __VLS_594)!;
let __VLS_596!: __VLS_NormalizeEmits<typeof __VLS_595.emit>;
(__VLS_595.slots!).default;
}
{
const __VLS_597 = __VLS_intrinsicElements["br"];
const __VLS_598 = __VLS_elementAsFunctionalComponent(__VLS_597);
const __VLS_599 = __VLS_598({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_598));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_597, typeof __VLS_599> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_600 = __VLS_pickFunctionalComponentCtx(__VLS_597, __VLS_599)!;
let __VLS_601!: __VLS_NormalizeEmits<typeof __VLS_600.emit>;
}
{
const __VLS_602 = __VLS_intrinsicElements["span"];
const __VLS_603 = __VLS_elementAsFunctionalComponent(__VLS_602);
const __VLS_604 = __VLS_603({ ...{}, class: ("text-3xl "), }, ...__VLS_functionalComponentArgsRest(__VLS_603));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_602, typeof __VLS_604> & Record<string, unknown>) => void)({ ...{}, class: ("text-3xl "), });
const __VLS_605 = __VLS_pickFunctionalComponentCtx(__VLS_602, __VLS_604)!;
let __VLS_606!: __VLS_NormalizeEmits<typeof __VLS_605.emit>;
(__VLS_605.slots!).default;
}
{
const __VLS_607 = __VLS_intrinsicElements["br"];
const __VLS_608 = __VLS_elementAsFunctionalComponent(__VLS_607);
const __VLS_609 = __VLS_608({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_608));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_607, typeof __VLS_609> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_610 = __VLS_pickFunctionalComponentCtx(__VLS_607, __VLS_609)!;
let __VLS_611!: __VLS_NormalizeEmits<typeof __VLS_610.emit>;
}
{
const __VLS_612 = __VLS_intrinsicElements["span"];
const __VLS_613 = __VLS_elementAsFunctionalComponent(__VLS_612);
const __VLS_614 = __VLS_613({ ...{}, class: ("text-3xl"), }, ...__VLS_functionalComponentArgsRest(__VLS_613));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_612, typeof __VLS_614> & Record<string, unknown>) => void)({ ...{}, class: ("text-3xl"), });
const __VLS_615 = __VLS_pickFunctionalComponentCtx(__VLS_612, __VLS_614)!;
let __VLS_616!: __VLS_NormalizeEmits<typeof __VLS_615.emit>;
{
const __VLS_617 = __VLS_intrinsicElements["span"];
const __VLS_618 = __VLS_elementAsFunctionalComponent(__VLS_617);
const __VLS_619 = __VLS_618({ ...{}, class: ("text-principal"), }, ...__VLS_functionalComponentArgsRest(__VLS_618));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_617, typeof __VLS_619> & Record<string, unknown>) => void)({ ...{}, class: ("text-principal"), });
const __VLS_620 = __VLS_pickFunctionalComponentCtx(__VLS_617, __VLS_619)!;
let __VLS_621!: __VLS_NormalizeEmits<typeof __VLS_620.emit>;
(__VLS_620.slots!).default;
}
(__VLS_ctx.phoneSeler);
(__VLS_615.slots!).default;
}
{
const __VLS_622 = __VLS_intrinsicElements["button"];
const __VLS_623 = __VLS_elementAsFunctionalComponent(__VLS_622);
const __VLS_624 = __VLS_623({ ...{ onClick: {} as any, }, class: ("absolute top-0 right-0 mt-2 mr-2 text-3xl text-principal hover:text-gray-800 focus:outline-none"), }, ...__VLS_functionalComponentArgsRest(__VLS_623));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_622, typeof __VLS_624> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("absolute top-0 right-0 mt-2 mr-2 text-3xl text-principal hover:text-gray-800 focus:outline-none"), });
const __VLS_625 = __VLS_pickFunctionalComponentCtx(__VLS_622, __VLS_624)!;
let __VLS_626!: __VLS_NormalizeEmits<typeof __VLS_625.emit>;
let __VLS_627 = { 'click': __VLS_pickEvent(__VLS_626['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_623, typeof __VLS_624>).onClick) };
__VLS_627 = { click: (__VLS_ctx.fermerPopup) };
(__VLS_625.slots!).default;
}
(__VLS_590.slots!).default;
}
(__VLS_585.slots!).default;
}
// @ts-ignore
[ouvrirWhatsApp, afficherNumero, afficherPopup, phoneSeler, fermerPopup,];
}
(__VLS_574.slots!).default;
}
(__VLS_563.slots!).default;
}
(__VLS_124.slots!).default;
}
(__VLS_119.slots!).default;
}
(__VLS_13.slots!).default;
}
{
const __VLS_628 = __VLS_intrinsicElements["div"];
const __VLS_629 = __VLS_elementAsFunctionalComponent(__VLS_628);
const __VLS_630 = __VLS_629({ ...{}, class: ("px-4 mt-4 rounded-sm sm:w-[40rem] sm:h-[22rem]  items-center sm:justify-center  relative my-0 sm:mx-0 "), }, ...__VLS_functionalComponentArgsRest(__VLS_629));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_628, typeof __VLS_630> & Record<string, unknown>) => void)({ ...{}, class: ("px-4 mt-4 rounded-sm sm:w-[40rem] sm:h-[22rem]  items-center sm:justify-center  relative my-0 sm:mx-0 "), });
const __VLS_631 = __VLS_pickFunctionalComponentCtx(__VLS_628, __VLS_630)!;
let __VLS_632!: __VLS_NormalizeEmits<typeof __VLS_631.emit>;
{
const __VLS_633 = __VLS_intrinsicElements["span"];
const __VLS_634 = __VLS_elementAsFunctionalComponent(__VLS_633);
const __VLS_635 = __VLS_634({ ...{}, class: ("text-secondaire uppercase text-2xl "), }, ...__VLS_functionalComponentArgsRest(__VLS_634));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_633, typeof __VLS_635> & Record<string, unknown>) => void)({ ...{}, class: ("text-secondaire uppercase text-2xl "), });
const __VLS_636 = __VLS_pickFunctionalComponentCtx(__VLS_633, __VLS_635)!;
let __VLS_637!: __VLS_NormalizeEmits<typeof __VLS_636.emit>;
(__VLS_ctx.maison.nom);
(__VLS_636.slots!).default;
}
{
const __VLS_638 = __VLS_intrinsicElements["br"];
const __VLS_639 = __VLS_elementAsFunctionalComponent(__VLS_638);
const __VLS_640 = __VLS_639({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_639));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_638, typeof __VLS_640> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_641 = __VLS_pickFunctionalComponentCtx(__VLS_638, __VLS_640)!;
let __VLS_642!: __VLS_NormalizeEmits<typeof __VLS_641.emit>;
}
{
const __VLS_643 = __VLS_intrinsicElements["span"];
const __VLS_644 = __VLS_elementAsFunctionalComponent(__VLS_643);
const __VLS_645 = __VLS_644({ ...{}, class: ("text-gray-500 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_644));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_643, typeof __VLS_645> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-500 mt-3"), });
const __VLS_646 = __VLS_pickFunctionalComponentCtx(__VLS_643, __VLS_645)!;
let __VLS_647!: __VLS_NormalizeEmits<typeof __VLS_646.emit>;
{
const __VLS_648 = __VLS_intrinsicElements["span"];
const __VLS_649 = __VLS_elementAsFunctionalComponent(__VLS_648);
const __VLS_650 = __VLS_649({ ...{}, class: ("text-principal uppercase"), }, ...__VLS_functionalComponentArgsRest(__VLS_649));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_648, typeof __VLS_650> & Record<string, unknown>) => void)({ ...{}, class: ("text-principal uppercase"), });
const __VLS_651 = __VLS_pickFunctionalComponentCtx(__VLS_648, __VLS_650)!;
let __VLS_652!: __VLS_NormalizeEmits<typeof __VLS_651.emit>;
(__VLS_ctx.maison.prix);
(__VLS_651.slots!).default;
}
(__VLS_646.slots!).default;
}
{
const __VLS_653 = __VLS_intrinsicElements["br"];
const __VLS_654 = __VLS_elementAsFunctionalComponent(__VLS_653);
const __VLS_655 = __VLS_654({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_654));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_653, typeof __VLS_655> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_656 = __VLS_pickFunctionalComponentCtx(__VLS_653, __VLS_655)!;
let __VLS_657!: __VLS_NormalizeEmits<typeof __VLS_656.emit>;
}
{
const __VLS_658 = __VLS_intrinsicElements["hr"];
const __VLS_659 = __VLS_elementAsFunctionalComponent(__VLS_658);
const __VLS_660 = __VLS_659({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_659));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_658, typeof __VLS_660> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_661 = __VLS_pickFunctionalComponentCtx(__VLS_658, __VLS_660)!;
let __VLS_662!: __VLS_NormalizeEmits<typeof __VLS_661.emit>;
}
{
const __VLS_663 = __VLS_intrinsicElements["div"];
const __VLS_664 = __VLS_elementAsFunctionalComponent(__VLS_663);
const __VLS_665 = __VLS_664({ ...{}, class: ("flex items-center mt-4"), }, ...__VLS_functionalComponentArgsRest(__VLS_664));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_663, typeof __VLS_665> & Record<string, unknown>) => void)({ ...{}, class: ("flex items-center mt-4"), });
const __VLS_666 = __VLS_pickFunctionalComponentCtx(__VLS_663, __VLS_665)!;
let __VLS_667!: __VLS_NormalizeEmits<typeof __VLS_666.emit>;
{
const __VLS_668 = __VLS_intrinsicElements["div"];
const __VLS_669 = __VLS_elementAsFunctionalComponent(__VLS_668);
const __VLS_670 = __VLS_669({ ...{}, class: ("w-full grid grid-cols-2 "), }, ...__VLS_functionalComponentArgsRest(__VLS_669));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_668, typeof __VLS_670> & Record<string, unknown>) => void)({ ...{}, class: ("w-full grid grid-cols-2 "), });
const __VLS_671 = __VLS_pickFunctionalComponentCtx(__VLS_668, __VLS_670)!;
let __VLS_672!: __VLS_NormalizeEmits<typeof __VLS_671.emit>;
{
const __VLS_673 = __VLS_intrinsicElements["div"];
const __VLS_674 = __VLS_elementAsFunctionalComponent(__VLS_673);
const __VLS_675 = __VLS_674({ ...{}, class: ("flex items-center mr-4"), }, ...__VLS_functionalComponentArgsRest(__VLS_674));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_673, typeof __VLS_675> & Record<string, unknown>) => void)({ ...{}, class: ("flex items-center mr-4"), });
const __VLS_676 = __VLS_pickFunctionalComponentCtx(__VLS_673, __VLS_675)!;
let __VLS_677!: __VLS_NormalizeEmits<typeof __VLS_676.emit>;
{
const __VLS_678 = __VLS_intrinsicElements["i"];
const __VLS_679 = __VLS_elementAsFunctionalComponent(__VLS_678);
const __VLS_680 = __VLS_679({ ...{}, class: ("bi bi-bag-fill text-3xl text-gray-800 mr-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_679));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_678, typeof __VLS_680> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-bag-fill text-3xl text-gray-800 mr-2"), });
const __VLS_681 = __VLS_pickFunctionalComponentCtx(__VLS_678, __VLS_680)!;
let __VLS_682!: __VLS_NormalizeEmits<typeof __VLS_681.emit>;
}
{
const __VLS_683 = __VLS_intrinsicElements["span"];
const __VLS_684 = __VLS_elementAsFunctionalComponent(__VLS_683);
const __VLS_685 = __VLS_684({ ...{}, class: ("text-1xl text-gray-600"), }, ...__VLS_functionalComponentArgsRest(__VLS_684));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_683, typeof __VLS_685> & Record<string, unknown>) => void)({ ...{}, class: ("text-1xl text-gray-600"), });
const __VLS_686 = __VLS_pickFunctionalComponentCtx(__VLS_683, __VLS_685)!;
let __VLS_687!: __VLS_NormalizeEmits<typeof __VLS_686.emit>;
(__VLS_ctx.maison.affaire);
(__VLS_686.slots!).default;
}
(__VLS_676.slots!).default;
}
{
const __VLS_688 = __VLS_intrinsicElements["div"];
const __VLS_689 = __VLS_elementAsFunctionalComponent(__VLS_688);
const __VLS_690 = __VLS_689({ ...{}, class: ("flex items-center mr-4"), }, ...__VLS_functionalComponentArgsRest(__VLS_689));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_688, typeof __VLS_690> & Record<string, unknown>) => void)({ ...{}, class: ("flex items-center mr-4"), });
const __VLS_691 = __VLS_pickFunctionalComponentCtx(__VLS_688, __VLS_690)!;
let __VLS_692!: __VLS_NormalizeEmits<typeof __VLS_691.emit>;
{
const __VLS_693 = __VLS_intrinsicElements["i"];
const __VLS_694 = __VLS_elementAsFunctionalComponent(__VLS_693);
const __VLS_695 = __VLS_694({ ...{}, class: ("bi bi-border-width text-3xl text-gray-800 mr-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_694));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_693, typeof __VLS_695> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-border-width text-3xl text-gray-800 mr-2"), });
const __VLS_696 = __VLS_pickFunctionalComponentCtx(__VLS_693, __VLS_695)!;
let __VLS_697!: __VLS_NormalizeEmits<typeof __VLS_696.emit>;
}
{
const __VLS_698 = __VLS_intrinsicElements["span"];
const __VLS_699 = __VLS_elementAsFunctionalComponent(__VLS_698);
const __VLS_700 = __VLS_699({ ...{}, class: ("text-1xl text-gray-600"), }, ...__VLS_functionalComponentArgsRest(__VLS_699));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_698, typeof __VLS_700> & Record<string, unknown>) => void)({ ...{}, class: ("text-1xl text-gray-600"), });
const __VLS_701 = __VLS_pickFunctionalComponentCtx(__VLS_698, __VLS_700)!;
let __VLS_702!: __VLS_NormalizeEmits<typeof __VLS_701.emit>;
(__VLS_ctx.maison.type);
(__VLS_701.slots!).default;
}
(__VLS_691.slots!).default;
}
{
const __VLS_703 = __VLS_intrinsicElements["div"];
const __VLS_704 = __VLS_elementAsFunctionalComponent(__VLS_703);
const __VLS_705 = __VLS_704({ ...{}, class: ("flex items-center mr-4"), }, ...__VLS_functionalComponentArgsRest(__VLS_704));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_703, typeof __VLS_705> & Record<string, unknown>) => void)({ ...{}, class: ("flex items-center mr-4"), });
const __VLS_706 = __VLS_pickFunctionalComponentCtx(__VLS_703, __VLS_705)!;
let __VLS_707!: __VLS_NormalizeEmits<typeof __VLS_706.emit>;
{
const __VLS_708 = __VLS_intrinsicElements["i"];
const __VLS_709 = __VLS_elementAsFunctionalComponent(__VLS_708);
const __VLS_710 = __VLS_709({ ...{}, class: ("bi bi-geo-alt-fill text-3xl text-gray-800 mr-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_709));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_708, typeof __VLS_710> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-geo-alt-fill text-3xl text-gray-800 mr-2"), });
const __VLS_711 = __VLS_pickFunctionalComponentCtx(__VLS_708, __VLS_710)!;
let __VLS_712!: __VLS_NormalizeEmits<typeof __VLS_711.emit>;
}
{
const __VLS_713 = __VLS_intrinsicElements["span"];
const __VLS_714 = __VLS_elementAsFunctionalComponent(__VLS_713);
const __VLS_715 = __VLS_714({ ...{}, class: ("text-1xl text-gray-600"), }, ...__VLS_functionalComponentArgsRest(__VLS_714));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_713, typeof __VLS_715> & Record<string, unknown>) => void)({ ...{}, class: ("text-1xl text-gray-600"), });
const __VLS_716 = __VLS_pickFunctionalComponentCtx(__VLS_713, __VLS_715)!;
let __VLS_717!: __VLS_NormalizeEmits<typeof __VLS_716.emit>;
(__VLS_ctx.maison.region);
(__VLS_716.slots!).default;
}
(__VLS_706.slots!).default;
}
{
const __VLS_718 = __VLS_intrinsicElements["div"];
const __VLS_719 = __VLS_elementAsFunctionalComponent(__VLS_718);
const __VLS_720 = __VLS_719({ ...{}, class: ("flex items-center mr-4"), }, ...__VLS_functionalComponentArgsRest(__VLS_719));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_718, typeof __VLS_720> & Record<string, unknown>) => void)({ ...{}, class: ("flex items-center mr-4"), });
const __VLS_721 = __VLS_pickFunctionalComponentCtx(__VLS_718, __VLS_720)!;
let __VLS_722!: __VLS_NormalizeEmits<typeof __VLS_721.emit>;
{
const __VLS_723 = __VLS_intrinsicElements["i"];
const __VLS_724 = __VLS_elementAsFunctionalComponent(__VLS_723);
const __VLS_725 = __VLS_724({ ...{}, class: ("bi bi-grid-3x3-gap-fill text-3xl text-gray-800 mr-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_724));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_723, typeof __VLS_725> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-grid-3x3-gap-fill text-3xl text-gray-800 mr-2"), });
const __VLS_726 = __VLS_pickFunctionalComponentCtx(__VLS_723, __VLS_725)!;
let __VLS_727!: __VLS_NormalizeEmits<typeof __VLS_726.emit>;
}
{
const __VLS_728 = __VLS_intrinsicElements["span"];
const __VLS_729 = __VLS_elementAsFunctionalComponent(__VLS_728);
const __VLS_730 = __VLS_729({ ...{}, class: ("text-1xl text-gray-600"), }, ...__VLS_functionalComponentArgsRest(__VLS_729));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_728, typeof __VLS_730> & Record<string, unknown>) => void)({ ...{}, class: ("text-1xl text-gray-600"), });
const __VLS_731 = __VLS_pickFunctionalComponentCtx(__VLS_728, __VLS_730)!;
let __VLS_732!: __VLS_NormalizeEmits<typeof __VLS_731.emit>;
(__VLS_ctx.maison.npiece);
(__VLS_731.slots!).default;
}
(__VLS_721.slots!).default;
}
{
const __VLS_733 = __VLS_intrinsicElements["div"];
const __VLS_734 = __VLS_elementAsFunctionalComponent(__VLS_733);
const __VLS_735 = __VLS_734({ ...{}, class: ("flex items-center mr-4"), }, ...__VLS_functionalComponentArgsRest(__VLS_734));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_733, typeof __VLS_735> & Record<string, unknown>) => void)({ ...{}, class: ("flex items-center mr-4"), });
const __VLS_736 = __VLS_pickFunctionalComponentCtx(__VLS_733, __VLS_735)!;
let __VLS_737!: __VLS_NormalizeEmits<typeof __VLS_736.emit>;
{
const __VLS_738 = __VLS_intrinsicElements["i"];
const __VLS_739 = __VLS_elementAsFunctionalComponent(__VLS_738);
const __VLS_740 = __VLS_739({ ...{}, class: ("bi bi-card-text text-3xl text-gray-800 mr-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_739));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_738, typeof __VLS_740> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-card-text text-3xl text-gray-800 mr-2"), });
const __VLS_741 = __VLS_pickFunctionalComponentCtx(__VLS_738, __VLS_740)!;
let __VLS_742!: __VLS_NormalizeEmits<typeof __VLS_741.emit>;
}
{
const __VLS_743 = __VLS_intrinsicElements["span"];
const __VLS_744 = __VLS_elementAsFunctionalComponent(__VLS_743);
const __VLS_745 = __VLS_744({ ...{}, class: ("text-1xl text-gray-600"), }, ...__VLS_functionalComponentArgsRest(__VLS_744));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_743, typeof __VLS_745> & Record<string, unknown>) => void)({ ...{}, class: ("text-1xl text-gray-600"), });
const __VLS_746 = __VLS_pickFunctionalComponentCtx(__VLS_743, __VLS_745)!;
let __VLS_747!: __VLS_NormalizeEmits<typeof __VLS_746.emit>;
(__VLS_ctx.maison.surface);
(__VLS_746.slots!).default;
}
(__VLS_736.slots!).default;
}
(__VLS_671.slots!).default;
}
(__VLS_666.slots!).default;
}
{
const __VLS_748 = __VLS_intrinsicElements["hr"];
const __VLS_749 = __VLS_elementAsFunctionalComponent(__VLS_748);
const __VLS_750 = __VLS_749({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_749));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_748, typeof __VLS_750> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_751 = __VLS_pickFunctionalComponentCtx(__VLS_748, __VLS_750)!;
let __VLS_752!: __VLS_NormalizeEmits<typeof __VLS_751.emit>;
}
{
const __VLS_753 = __VLS_intrinsicElements["p"];
const __VLS_754 = __VLS_elementAsFunctionalComponent(__VLS_753);
const __VLS_755 = __VLS_754({ ...{}, class: ("text-gray-600 mt-3"), }, ...__VLS_functionalComponentArgsRest(__VLS_754));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_753, typeof __VLS_755> & Record<string, unknown>) => void)({ ...{}, class: ("text-gray-600 mt-3"), });
const __VLS_756 = __VLS_pickFunctionalComponentCtx(__VLS_753, __VLS_755)!;
let __VLS_757!: __VLS_NormalizeEmits<typeof __VLS_756.emit>;
(__VLS_ctx.maison.description);
(__VLS_756.slots!).default;
}
{
const __VLS_758 = __VLS_intrinsicElements["br"];
const __VLS_759 = __VLS_elementAsFunctionalComponent(__VLS_758);
const __VLS_760 = __VLS_759({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_759));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_758, typeof __VLS_760> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_761 = __VLS_pickFunctionalComponentCtx(__VLS_758, __VLS_760)!;
let __VLS_762!: __VLS_NormalizeEmits<typeof __VLS_761.emit>;
}
{
const __VLS_763 = __VLS_intrinsicElements["div"];
const __VLS_764 = __VLS_elementAsFunctionalComponent(__VLS_763);
const __VLS_765 = __VLS_764({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_764));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_763, typeof __VLS_765> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_766 = __VLS_pickFunctionalComponentCtx(__VLS_763, __VLS_765)!;
let __VLS_767!: __VLS_NormalizeEmits<typeof __VLS_766.emit>;
{
const __VLS_768 = __VLS_intrinsicElements["h2"];
const __VLS_769 = __VLS_elementAsFunctionalComponent(__VLS_768);
const __VLS_770 = __VLS_769({ ...{}, class: ("text-2xl font-semibold mb-4 text-secondaire"), }, ...__VLS_functionalComponentArgsRest(__VLS_769));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_768, typeof __VLS_770> & Record<string, unknown>) => void)({ ...{}, class: ("text-2xl font-semibold mb-4 text-secondaire"), });
const __VLS_771 = __VLS_pickFunctionalComponentCtx(__VLS_768, __VLS_770)!;
let __VLS_772!: __VLS_NormalizeEmits<typeof __VLS_771.emit>;
(__VLS_771.slots!).default;
}
{
const __VLS_773 = __VLS_intrinsicElements["br"];
const __VLS_774 = __VLS_elementAsFunctionalComponent(__VLS_773);
const __VLS_775 = __VLS_774({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_774));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_773, typeof __VLS_775> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_776 = __VLS_pickFunctionalComponentCtx(__VLS_773, __VLS_775)!;
let __VLS_777!: __VLS_NormalizeEmits<typeof __VLS_776.emit>;
}
{
const __VLS_778 = __VLS_intrinsicElements["div"];
const __VLS_779 = __VLS_elementAsFunctionalComponent(__VLS_778);
const __VLS_780 = __VLS_779({ ...{}, class: ("grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 "), }, ...__VLS_functionalComponentArgsRest(__VLS_779));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_778, typeof __VLS_780> & Record<string, unknown>) => void)({ ...{}, class: ("grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 "), });
const __VLS_781 = __VLS_pickFunctionalComponentCtx(__VLS_778, __VLS_780)!;
let __VLS_782!: __VLS_NormalizeEmits<typeof __VLS_781.emit>;
for (const [suggestion] of __VLS_getVForSourceType((__VLS_ctx.suggestions)!)) {
{
const __VLS_783 = __VLS_intrinsicElements["div"];
const __VLS_784 = __VLS_elementAsFunctionalComponent(__VLS_783);
const __VLS_785 = __VLS_784({ ...{}, key: ((suggestion.id)), class: (" w-full h-full object-cover border rounded-lg p-1"), }, ...__VLS_functionalComponentArgsRest(__VLS_784));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_783, typeof __VLS_785> & Record<string, unknown>) => void)({ ...{}, key: ((suggestion.id)), class: (" w-full h-full object-cover border rounded-lg p-1"), });
const __VLS_786 = __VLS_pickFunctionalComponentCtx(__VLS_783, __VLS_785)!;
let __VLS_787!: __VLS_NormalizeEmits<typeof __VLS_786.emit>;
{
const __VLS_788 = __VLS_intrinsicElements["img"];
const __VLS_789 = __VLS_elementAsFunctionalComponent(__VLS_788);
const __VLS_790 = __VLS_789({ ...{}, src: (('/storage/' + suggestion.image1)), alt: ("Produit"), class: ("w-full h-auto mb-2 rounded-lg"), }, ...__VLS_functionalComponentArgsRest(__VLS_789));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_788, typeof __VLS_790> & Record<string, unknown>) => void)({ ...{}, src: (('/storage/' + suggestion.image1)), alt: ("Produit"), class: ("w-full h-auto mb-2 rounded-lg"), });
const __VLS_791 = __VLS_pickFunctionalComponentCtx(__VLS_788, __VLS_790)!;
let __VLS_792!: __VLS_NormalizeEmits<typeof __VLS_791.emit>;
}
{
const __VLS_793 = __VLS_intrinsicElements["span"];
const __VLS_794 = __VLS_elementAsFunctionalComponent(__VLS_793);
const __VLS_795 = __VLS_794({ ...{}, class: ("text-md font-semibold text-principal text-center "), }, ...__VLS_functionalComponentArgsRest(__VLS_794));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_793, typeof __VLS_795> & Record<string, unknown>) => void)({ ...{}, class: ("text-md font-semibold text-principal text-center "), });
const __VLS_796 = __VLS_pickFunctionalComponentCtx(__VLS_793, __VLS_795)!;
let __VLS_797!: __VLS_NormalizeEmits<typeof __VLS_796.emit>;
(suggestion.nom);
(__VLS_796.slots!).default;
}
(__VLS_786.slots!).default;
}
// @ts-ignore
[maison, maison, maison, maison, maison, maison, maison, maison, suggestions,];
}
(__VLS_781.slots!).default;
}
(__VLS_766.slots!).default;
}
(__VLS_631.slots!).default;
}
{
const __VLS_798 = __VLS_intrinsicElements["div"];
const __VLS_799 = __VLS_elementAsFunctionalComponent(__VLS_798);
const __VLS_800 = __VLS_799({ ...{}, class: ("fixed bottom-0 w-full bg-transparent text-white p-4 flex mx-auto justify-around md:hidden"), }, ...__VLS_functionalComponentArgsRest(__VLS_799));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_798, typeof __VLS_800> & Record<string, unknown>) => void)({ ...{}, class: ("fixed bottom-0 w-full bg-transparent text-white p-4 flex mx-auto justify-around md:hidden"), });
const __VLS_801 = __VLS_pickFunctionalComponentCtx(__VLS_798, __VLS_800)!;
let __VLS_802!: __VLS_NormalizeEmits<typeof __VLS_801.emit>;
{
const __VLS_803 = __VLS_intrinsicElements["div"];
const __VLS_804 = __VLS_elementAsFunctionalComponent(__VLS_803);
const __VLS_805 = __VLS_804({ ...{}, class: ("first"), }, ...__VLS_functionalComponentArgsRest(__VLS_804));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_803, typeof __VLS_805> & Record<string, unknown>) => void)({ ...{}, class: ("first"), });
const __VLS_806 = __VLS_pickFunctionalComponentCtx(__VLS_803, __VLS_805)!;
let __VLS_807!: __VLS_NormalizeEmits<typeof __VLS_806.emit>;
{
const __VLS_808 = __VLS_intrinsicElements["button"];
const __VLS_809 = __VLS_elementAsFunctionalComponent(__VLS_808);
const __VLS_810 = __VLS_809({ ...{ onClick: {} as any, }, class: ("flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_809));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_808, typeof __VLS_810> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2"), });
const __VLS_811 = __VLS_pickFunctionalComponentCtx(__VLS_808, __VLS_810)!;
let __VLS_812!: __VLS_NormalizeEmits<typeof __VLS_811.emit>;
let __VLS_813 = { 'click': __VLS_pickEvent(__VLS_812['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_809, typeof __VLS_810>).onClick) };
__VLS_813 = { click: (__VLS_ctx.afficherNumero) };
{
const __VLS_814 = __VLS_intrinsicElements["i"];
const __VLS_815 = __VLS_elementAsFunctionalComponent(__VLS_814);
const __VLS_816 = __VLS_815({ ...{}, class: ("bi bi-telephone text-3xl mr-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_815));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_814, typeof __VLS_816> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-telephone text-3xl mr-2"), });
const __VLS_817 = __VLS_pickFunctionalComponentCtx(__VLS_814, __VLS_816)!;
let __VLS_818!: __VLS_NormalizeEmits<typeof __VLS_817.emit>;
}
(__VLS_811.slots!).default;
}
if (__VLS_ctx.afficherPopup) {
{
const __VLS_819 = __VLS_intrinsicElements["div"];
const __VLS_820 = __VLS_elementAsFunctionalComponent(__VLS_819);
const __VLS_821 = __VLS_820({ ...{}, class: ("w-11/12 mx-auto fixed inset-0 flex justify-center bg-gray-800 bg-opacity-75"), }, ...__VLS_functionalComponentArgsRest(__VLS_820));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_819, typeof __VLS_821> & Record<string, unknown>) => void)({ ...{}, class: ("w-11/12 mx-auto fixed inset-0 flex justify-center bg-gray-800 bg-opacity-75"), });
const __VLS_822 = __VLS_pickFunctionalComponentCtx(__VLS_819, __VLS_821)!;
let __VLS_823!: __VLS_NormalizeEmits<typeof __VLS_822.emit>;
{
const __VLS_824 = __VLS_intrinsicElements["div"];
const __VLS_825 = __VLS_elementAsFunctionalComponent(__VLS_824);
const __VLS_826 = __VLS_825({ ...{}, class: ("bg-white rounded-lg p-8"), }, ...__VLS_functionalComponentArgsRest(__VLS_825));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_824, typeof __VLS_826> & Record<string, unknown>) => void)({ ...{}, class: ("bg-white rounded-lg p-8"), });
const __VLS_827 = __VLS_pickFunctionalComponentCtx(__VLS_824, __VLS_826)!;
let __VLS_828!: __VLS_NormalizeEmits<typeof __VLS_827.emit>;
{
const __VLS_829 = __VLS_intrinsicElements["span"];
const __VLS_830 = __VLS_elementAsFunctionalComponent(__VLS_829);
const __VLS_831 = __VLS_830({ ...{}, class: ("text-3xl text-principal"), }, ...__VLS_functionalComponentArgsRest(__VLS_830));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_829, typeof __VLS_831> & Record<string, unknown>) => void)({ ...{}, class: ("text-3xl text-principal"), });
const __VLS_832 = __VLS_pickFunctionalComponentCtx(__VLS_829, __VLS_831)!;
let __VLS_833!: __VLS_NormalizeEmits<typeof __VLS_832.emit>;
(__VLS_832.slots!).default;
}
{
const __VLS_834 = __VLS_intrinsicElements["br"];
const __VLS_835 = __VLS_elementAsFunctionalComponent(__VLS_834);
const __VLS_836 = __VLS_835({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_835));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_834, typeof __VLS_836> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_837 = __VLS_pickFunctionalComponentCtx(__VLS_834, __VLS_836)!;
let __VLS_838!: __VLS_NormalizeEmits<typeof __VLS_837.emit>;
}
{
const __VLS_839 = __VLS_intrinsicElements["span"];
const __VLS_840 = __VLS_elementAsFunctionalComponent(__VLS_839);
const __VLS_841 = __VLS_840({ ...{}, class: ("text-1xl text-black"), }, ...__VLS_functionalComponentArgsRest(__VLS_840));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_839, typeof __VLS_841> & Record<string, unknown>) => void)({ ...{}, class: ("text-1xl text-black"), });
const __VLS_842 = __VLS_pickFunctionalComponentCtx(__VLS_839, __VLS_841)!;
let __VLS_843!: __VLS_NormalizeEmits<typeof __VLS_842.emit>;
(__VLS_842.slots!).default;
}
{
const __VLS_844 = __VLS_intrinsicElements["br"];
const __VLS_845 = __VLS_elementAsFunctionalComponent(__VLS_844);
const __VLS_846 = __VLS_845({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_845));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_844, typeof __VLS_846> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_847 = __VLS_pickFunctionalComponentCtx(__VLS_844, __VLS_846)!;
let __VLS_848!: __VLS_NormalizeEmits<typeof __VLS_847.emit>;
}
{
const __VLS_849 = __VLS_intrinsicElements["br"];
const __VLS_850 = __VLS_elementAsFunctionalComponent(__VLS_849);
const __VLS_851 = __VLS_850({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_850));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_849, typeof __VLS_851> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_852 = __VLS_pickFunctionalComponentCtx(__VLS_849, __VLS_851)!;
let __VLS_853!: __VLS_NormalizeEmits<typeof __VLS_852.emit>;
}
{
const __VLS_854 = __VLS_intrinsicElements["hr"];
const __VLS_855 = __VLS_elementAsFunctionalComponent(__VLS_854);
const __VLS_856 = __VLS_855({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_855));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_854, typeof __VLS_856> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_857 = __VLS_pickFunctionalComponentCtx(__VLS_854, __VLS_856)!;
let __VLS_858!: __VLS_NormalizeEmits<typeof __VLS_857.emit>;
}
{
const __VLS_859 = __VLS_intrinsicElements["span"];
const __VLS_860 = __VLS_elementAsFunctionalComponent(__VLS_859);
const __VLS_861 = __VLS_860({ ...{}, class: ("text-1xl text-black"), }, ...__VLS_functionalComponentArgsRest(__VLS_860));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_859, typeof __VLS_861> & Record<string, unknown>) => void)({ ...{}, class: ("text-1xl text-black"), });
const __VLS_862 = __VLS_pickFunctionalComponentCtx(__VLS_859, __VLS_861)!;
let __VLS_863!: __VLS_NormalizeEmits<typeof __VLS_862.emit>;
(__VLS_862.slots!).default;
}
{
const __VLS_864 = __VLS_intrinsicElements["span"];
const __VLS_865 = __VLS_elementAsFunctionalComponent(__VLS_864);
const __VLS_866 = __VLS_865({ ...{}, class: ("text-principal"), }, ...__VLS_functionalComponentArgsRest(__VLS_865));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_864, typeof __VLS_866> & Record<string, unknown>) => void)({ ...{}, class: ("text-principal"), });
const __VLS_867 = __VLS_pickFunctionalComponentCtx(__VLS_864, __VLS_866)!;
let __VLS_868!: __VLS_NormalizeEmits<typeof __VLS_867.emit>;
(__VLS_ctx.phoneSeler);
(__VLS_867.slots!).default;
}
{
const __VLS_869 = __VLS_intrinsicElements["button"];
const __VLS_870 = __VLS_elementAsFunctionalComponent(__VLS_869);
const __VLS_871 = __VLS_870({ ...{ onClick: {} as any, }, class: ("absolute top-0 right-0 mt-2 mr-2 text-1xl text-gray-600 hover:text-gray-800 focus:outline-none"), }, ...__VLS_functionalComponentArgsRest(__VLS_870));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_869, typeof __VLS_871> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("absolute top-0 right-0 mt-2 mr-2 text-1xl text-gray-600 hover:text-gray-800 focus:outline-none"), });
const __VLS_872 = __VLS_pickFunctionalComponentCtx(__VLS_869, __VLS_871)!;
let __VLS_873!: __VLS_NormalizeEmits<typeof __VLS_872.emit>;
let __VLS_874 = { 'click': __VLS_pickEvent(__VLS_873['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_870, typeof __VLS_871>).onClick) };
__VLS_874 = { click: (__VLS_ctx.fermerPopup) };
(__VLS_872.slots!).default;
}
(__VLS_827.slots!).default;
}
(__VLS_822.slots!).default;
}
// @ts-ignore
[afficherNumero, afficherPopup, phoneSeler, fermerPopup,];
}
(__VLS_806.slots!).default;
}
{
const __VLS_875 = __VLS_intrinsicElements["div"];
const __VLS_876 = __VLS_elementAsFunctionalComponent(__VLS_875);
const __VLS_877 = __VLS_876({ ...{}, class: ("second"), }, ...__VLS_functionalComponentArgsRest(__VLS_876));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_875, typeof __VLS_877> & Record<string, unknown>) => void)({ ...{}, class: ("second"), });
const __VLS_878 = __VLS_pickFunctionalComponentCtx(__VLS_875, __VLS_877)!;
let __VLS_879!: __VLS_NormalizeEmits<typeof __VLS_878.emit>;
{
const __VLS_880 = __VLS_intrinsicElements["button"];
const __VLS_881 = __VLS_elementAsFunctionalComponent(__VLS_880);
const __VLS_882 = __VLS_881({ ...{ onClick: {} as any, }, class: ("flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_881));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_880, typeof __VLS_882> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2"), });
const __VLS_883 = __VLS_pickFunctionalComponentCtx(__VLS_880, __VLS_882)!;
let __VLS_884!: __VLS_NormalizeEmits<typeof __VLS_883.emit>;
let __VLS_885 = { 'click': __VLS_pickEvent(__VLS_884['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_881, typeof __VLS_882>).onClick) };
__VLS_885 = { click: (__VLS_ctx.ouvrirWhatsApp) };
{
const __VLS_886 = __VLS_intrinsicElements["i"];
const __VLS_887 = __VLS_elementAsFunctionalComponent(__VLS_886);
const __VLS_888 = __VLS_887({ ...{}, class: ("bi bi-whatsapp text-3xl mr-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_887));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_886, typeof __VLS_888> & Record<string, unknown>) => void)({ ...{}, class: ("bi bi-whatsapp text-3xl mr-2"), });
const __VLS_889 = __VLS_pickFunctionalComponentCtx(__VLS_886, __VLS_888)!;
let __VLS_890!: __VLS_NormalizeEmits<typeof __VLS_889.emit>;
}
(__VLS_883.slots!).default;
}
(__VLS_878.slots!).default;
}
(__VLS_801.slots!).default;
}
{
const __VLS_891 = __VLS_intrinsicElements["div"];
const __VLS_892 = __VLS_elementAsFunctionalComponent(__VLS_891);
const __VLS_893 = __VLS_892({ ...{}, class: ("footer relative top-12 mt-40 "), }, ...__VLS_functionalComponentArgsRest(__VLS_892));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_891, typeof __VLS_893> & Record<string, unknown>) => void)({ ...{}, class: ("footer relative top-12 mt-40 "), });
const __VLS_894 = __VLS_pickFunctionalComponentCtx(__VLS_891, __VLS_893)!;
let __VLS_895!: __VLS_NormalizeEmits<typeof __VLS_894.emit>;
{
const __VLS_896 = ({} as 'Footer' extends keyof typeof __VLS_ctx ? { 'Footer': typeof __VLS_ctx.Footer; } : typeof __VLS_resolvedLocalAndGlobalComponents).Footer;
const __VLS_897 = __VLS_asFunctionalComponent(__VLS_896, new __VLS_896({ ...{}, }));
({} as { Footer: typeof __VLS_896; }).Footer;
const __VLS_898 = __VLS_897({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_897));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_896, typeof __VLS_898> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_899 = __VLS_pickFunctionalComponentCtx(__VLS_896, __VLS_898)!;
let __VLS_900!: __VLS_NormalizeEmits<typeof __VLS_899.emit>;
}
(__VLS_894.slots!).default;
}
if (typeof __VLS_styleScopedClasses === 'object' && !Array.isArray(__VLS_styleScopedClasses)) {
}
var __VLS_slots!: {};
// @ts-ignore
[ouvrirWhatsApp,];
return __VLS_slots;
}
const __VLS_internalComponent = (await import('vue')).defineComponent({
setup() {
return {
$props: __VLS_makeOptional(props),
...props,
Head: Head as typeof Head,
Link: Link as typeof Link,
Footer: Footer as typeof Footer,
};
},

components: { Footer },
//     props: {
//     maison: Object,
//     user:Object,
//     nameSeler:Object,
//     mailSeler:Object,
//     phoneSeler:Object,
//   },
components: {
Head
},
data() {
return {
images: [
this.maison.image1,
this.maison.image2,
this.maison.image3,
],
currentIndex: 0,
showUserNumber: false,
//   nnnum
afficherPopup: false,
};
},
computed: {
currentImage() {
return this.images[this.currentIndex];

}
},
methods: {
previousImage() {
if (this.currentIndex > 0) {
this.currentIndex--;
}
},
nextImage() {
if (this.currentIndex < this.images.length - 1) {
this.currentIndex++;
}
},
afficherNumero() {
this.afficherPopup = true;
},
fermerPopup() {
this.afficherPopup = false;
}, ouvrirWhatsApp() {
const numeroContact = `${this.phoneSeler}`; // Remplacez par le numéro de téléphone que vous souhaitez utiliser
const messageText = `Bonjour, je suis intéressé par vos produits.${this.urlActuelle}`; // Message texte par défaut

const lienWhatsApp = `https://wa.me/${numeroContact}?text=${encodeURIComponent(messageText)}`;






// Ouvrir le lien dans une nouvelle fenêtre/onglet
window.open(lienWhatsApp, "_blank");
},
// envoie
}
});
return (await import('vue')).defineComponent({
setup() {
return {
$props: __VLS_makeOptional(props),
...props,
};
},

components: { Footer },
//     props: {
//     maison: Object,
//     user:Object,
//     nameSeler:Object,
//     mailSeler:Object,
//     phoneSeler:Object,
//   },
components: {
Head
},
data() {
return {
images: [
this.maison.image1,
this.maison.image2,
this.maison.image3,
],
currentIndex: 0,
showUserNumber: false,
//   nnnum
afficherPopup: false,
};
},
computed: {
currentImage() {
return this.images[this.currentIndex];

}
},
methods: {
previousImage() {
if (this.currentIndex > 0) {
this.currentIndex--;
}
},
nextImage() {
if (this.currentIndex < this.images.length - 1) {
this.currentIndex++;
}
},
afficherNumero() {
this.afficherPopup = true;
},
fermerPopup() {
this.afficherPopup = false;
}, ouvrirWhatsApp() {
const numeroContact = `${this.phoneSeler}`; // Remplacez par le numéro de téléphone que vous souhaitez utiliser
const messageText = `Bonjour, je suis intéressé par vos produits.${this.urlActuelle}`; // Message texte par défaut

const lienWhatsApp = `https://wa.me/${numeroContact}?text=${encodeURIComponent(messageText)}`;






// Ouvrir le lien dans une nouvelle fenêtre/onglet
window.open(lienWhatsApp, "_blank");
},
// envoie
}
});
})();
