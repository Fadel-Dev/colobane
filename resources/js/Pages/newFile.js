import AppLayout from '@/Layouts/AppLayout.vue';

defaultawait(async () => {
const { defineProps, defineSlots, defineEmits, defineExpose, defineModel, defineOptions, withDefaults, } = await import('vue');
const props = defineProps({
dashNomV: Array,
dashPrixV: Array,
dashImageV: Array,
dashIdV: Array
});

const __VLS_componentsOption = {};

let __VLS_name!: 'Dashboard';
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
__VLS_WithComponent<'AppLayout', typeof __VLS_localComponents, "AppLayout", "AppLayout", "AppLayout">;
__VLS_components.AppLayout; __VLS_components.AppLayout;
// @ts-ignore
[AppLayout, AppLayout,];
__VLS_intrinsicElements.template; __VLS_intrinsicElements.template;
__VLS_intrinsicElements.h2; __VLS_intrinsicElements.h2; __VLS_intrinsicElements.h2; __VLS_intrinsicElements.h2;
__VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div; __VLS_intrinsicElements.div;
__VLS_intrinsicElements.img;
__VLS_intrinsicElements.p; __VLS_intrinsicElements.p; __VLS_intrinsicElements.p; __VLS_intrinsicElements.p;
__VLS_intrinsicElements.button; __VLS_intrinsicElements.button;
{
const __VLS_0 = ({} as 'AppLayout' extends keyof typeof __VLS_ctx ? { 'AppLayout': typeof __VLS_ctx.AppLayout; } : typeof __VLS_resolvedLocalAndGlobalComponents).AppLayout;
const __VLS_1 = __VLS_asFunctionalComponent(__VLS_0, new __VLS_0({ ...{}, title: ("Dashboard"), }));
({} as { AppLayout: typeof __VLS_0; }).AppLayout;
({} as { AppLayout: typeof __VLS_0; }).AppLayout;
const __VLS_2 = __VLS_1({ ...{}, title: ("Dashboard"), }, ...__VLS_functionalComponentArgsRest(__VLS_1));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_0, typeof __VLS_2> & Record<string, unknown>) => void)({ ...{}, title: ("Dashboard"), });
const __VLS_3 = __VLS_pickFunctionalComponentCtx(__VLS_0, __VLS_2)!;
let __VLS_4!: __VLS_NormalizeEmits<typeof __VLS_3.emit>;
{
const __VLS_5 = __VLS_intrinsicElements["template"];
const __VLS_6 = __VLS_elementAsFunctionalComponent(__VLS_5);
const __VLS_7 = __VLS_6({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_6));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_5, typeof __VLS_7> & Record<string, unknown>) => void)({ ...{}, });
{
const __VLS_8 = __VLS_intrinsicElements["h2"];
const __VLS_9 = __VLS_elementAsFunctionalComponent(__VLS_8);
const __VLS_10 = __VLS_9({ ...{}, class: ("font-semibold text-xl text-gray-800 leading-tight"), }, ...__VLS_functionalComponentArgsRest(__VLS_9));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_8, typeof __VLS_10> & Record<string, unknown>) => void)({ ...{}, class: ("font-semibold text-xl text-gray-800 leading-tight"), });
const __VLS_11 = __VLS_pickFunctionalComponentCtx(__VLS_8, __VLS_10)!;
let __VLS_12!: __VLS_NormalizeEmits<typeof __VLS_11.emit>;
(__VLS_11.slots!).default;
}
(__VLS_3.slots!).default;
}
{
const __VLS_13 = __VLS_intrinsicElements["div"];
const __VLS_14 = __VLS_elementAsFunctionalComponent(__VLS_13);
const __VLS_15 = __VLS_14({ ...{ onClick: {} as any, }, class: ("bg-white text-slate-900"), }, ...__VLS_functionalComponentArgsRest(__VLS_14));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_13, typeof __VLS_15> & Record<string, unknown>) => void)({ ...{ onClick: {} as any, }, class: ("bg-white text-slate-900"), });
const __VLS_16 = __VLS_pickFunctionalComponentCtx(__VLS_13, __VLS_15)!;
let __VLS_17!: __VLS_NormalizeEmits<typeof __VLS_16.emit>;
let __VLS_18 = { 'click': __VLS_pickEvent(__VLS_17['click'], ({} as __VLS_FunctionalComponentProps<typeof __VLS_14, typeof __VLS_15>).onClick) };
__VLS_18 = {
click: $event => {
__VLS_ctx.navigateToDetailVehi();
// @ts-ignore
[navigateToDetailVehi,];
}
};
{
const __VLS_19 = __VLS_intrinsicElements["div"];
const __VLS_20 = __VLS_elementAsFunctionalComponent(__VLS_19);
const __VLS_21 = __VLS_20({ ...{}, class: ("mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8"), }, ...__VLS_functionalComponentArgsRest(__VLS_20));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_19, typeof __VLS_21> & Record<string, unknown>) => void)({ ...{}, class: ("mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8"), });
const __VLS_22 = __VLS_pickFunctionalComponentCtx(__VLS_19, __VLS_21)!;
let __VLS_23!: __VLS_NormalizeEmits<typeof __VLS_22.emit>;
{
const __VLS_24 = __VLS_intrinsicElements["h2"];
const __VLS_25 = __VLS_elementAsFunctionalComponent(__VLS_24);
const __VLS_26 = __VLS_25({ ...{}, class: ("text-2xl font-bold tracking-tight text-gray-900"), }, ...__VLS_functionalComponentArgsRest(__VLS_25));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_24, typeof __VLS_26> & Record<string, unknown>) => void)({ ...{}, class: ("text-2xl font-bold tracking-tight text-gray-900"), });
const __VLS_27 = __VLS_pickFunctionalComponentCtx(__VLS_24, __VLS_26)!;
let __VLS_28!: __VLS_NormalizeEmits<typeof __VLS_27.emit>;
(__VLS_ctx.$page.props.auth.user.name);
(__VLS_27.slots!).default;
}
{
const __VLS_29 = __VLS_intrinsicElements["div"];
const __VLS_30 = __VLS_elementAsFunctionalComponent(__VLS_29);
const __VLS_31 = __VLS_30({ ...{}, class: ("mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"), }, ...__VLS_functionalComponentArgsRest(__VLS_30));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_29, typeof __VLS_31> & Record<string, unknown>) => void)({ ...{}, class: ("mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"), });
const __VLS_32 = __VLS_pickFunctionalComponentCtx(__VLS_29, __VLS_31)!;
let __VLS_33!: __VLS_NormalizeEmits<typeof __VLS_32.emit>;
{
const __VLS_34 = __VLS_intrinsicElements["div"];
const __VLS_35 = __VLS_elementAsFunctionalComponent(__VLS_34);
const __VLS_36 = __VLS_35({ ...{}, class: ("group relative"), }, ...__VLS_functionalComponentArgsRest(__VLS_35));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_34, typeof __VLS_36> & Record<string, unknown>) => void)({ ...{}, class: ("group relative"), });
const __VLS_37 = __VLS_pickFunctionalComponentCtx(__VLS_34, __VLS_36)!;
let __VLS_38!: __VLS_NormalizeEmits<typeof __VLS_37.emit>;
{
const __VLS_39 = __VLS_intrinsicElements["div"];
const __VLS_40 = __VLS_elementAsFunctionalComponent(__VLS_39);
const __VLS_41 = __VLS_40({ ...{}, class: ("min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80"), }, ...__VLS_functionalComponentArgsRest(__VLS_40));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_39, typeof __VLS_41> & Record<string, unknown>) => void)({ ...{}, class: ("min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80"), });
const __VLS_42 = __VLS_pickFunctionalComponentCtx(__VLS_39, __VLS_41)!;
let __VLS_43!: __VLS_NormalizeEmits<typeof __VLS_42.emit>;
{
const __VLS_44 = __VLS_intrinsicElements["img"];
const __VLS_45 = __VLS_elementAsFunctionalComponent(__VLS_44);
const __VLS_46 = __VLS_45({ ...{}, src: (('/storage/' + __VLS_ctx.dashImageV)), class: ("h-full w-full object-cover object-center lg:h-full lg:w-full"), }, ...__VLS_functionalComponentArgsRest(__VLS_45));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_44, typeof __VLS_46> & Record<string, unknown>) => void)({ ...{}, src: (('/storage/' + __VLS_ctx.dashImageV)), class: ("h-full w-full object-cover object-center lg:h-full lg:w-full"), });
const __VLS_47 = __VLS_pickFunctionalComponentCtx(__VLS_44, __VLS_46)!;
let __VLS_48!: __VLS_NormalizeEmits<typeof __VLS_47.emit>;
}
(__VLS_42.slots!).default;
}
{
const __VLS_49 = __VLS_intrinsicElements["div"];
const __VLS_50 = __VLS_elementAsFunctionalComponent(__VLS_49);
const __VLS_51 = __VLS_50({ ...{}, class: ("mt-4 flex justify-between"), }, ...__VLS_functionalComponentArgsRest(__VLS_50));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_49, typeof __VLS_51> & Record<string, unknown>) => void)({ ...{}, class: ("mt-4 flex justify-between"), });
const __VLS_52 = __VLS_pickFunctionalComponentCtx(__VLS_49, __VLS_51)!;
let __VLS_53!: __VLS_NormalizeEmits<typeof __VLS_52.emit>;
{
const __VLS_54 = __VLS_intrinsicElements["div"];
const __VLS_55 = __VLS_elementAsFunctionalComponent(__VLS_54);
const __VLS_56 = __VLS_55({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_55));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_54, typeof __VLS_56> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_57 = __VLS_pickFunctionalComponentCtx(__VLS_54, __VLS_56)!;
let __VLS_58!: __VLS_NormalizeEmits<typeof __VLS_57.emit>;
(__VLS_57.slots!).default;
}
{
const __VLS_59 = __VLS_intrinsicElements["p"];
const __VLS_60 = __VLS_elementAsFunctionalComponent(__VLS_59);
const __VLS_61 = __VLS_60({ ...{}, class: ("text-sm font-medium text-gray-900"), }, ...__VLS_functionalComponentArgsRest(__VLS_60));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_59, typeof __VLS_61> & Record<string, unknown>) => void)({ ...{}, class: ("text-sm font-medium text-gray-900"), });
const __VLS_62 = __VLS_pickFunctionalComponentCtx(__VLS_59, __VLS_61)!;
let __VLS_63!: __VLS_NormalizeEmits<typeof __VLS_62.emit>;
(__VLS_ctx.dashPrixV);
(__VLS_62.slots!).default;
}
{
const __VLS_64 = __VLS_intrinsicElements["p"];
const __VLS_65 = __VLS_elementAsFunctionalComponent(__VLS_64);
const __VLS_66 = __VLS_65({ ...{}, class: ("text-sm font-medium text-gray-900"), }, ...__VLS_functionalComponentArgsRest(__VLS_65));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_64, typeof __VLS_66> & Record<string, unknown>) => void)({ ...{}, class: ("text-sm font-medium text-gray-900"), });
const __VLS_67 = __VLS_pickFunctionalComponentCtx(__VLS_64, __VLS_66)!;
let __VLS_68!: __VLS_NormalizeEmits<typeof __VLS_67.emit>;
(__VLS_ctx.dashNomV);
(__VLS_67.slots!).default;
}
{
const __VLS_69 = __VLS_intrinsicElements["button"];
const __VLS_70 = __VLS_elementAsFunctionalComponent(__VLS_69);
const __VLS_71 = __VLS_70({ ...{}, }, ...__VLS_functionalComponentArgsRest(__VLS_70));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_69, typeof __VLS_71> & Record<string, unknown>) => void)({ ...{}, });
const __VLS_72 = __VLS_pickFunctionalComponentCtx(__VLS_69, __VLS_71)!;
let __VLS_73!: __VLS_NormalizeEmits<typeof __VLS_72.emit>;
(__VLS_72.slots!).default;
}
(__VLS_52.slots!).default;
}
(__VLS_37.slots!).default;
}
(__VLS_32.slots!).default;
}
(__VLS_22.slots!).default;
}
(__VLS_16.slots!).default;
}
(__VLS_3.slots!).default;
}
if (typeof __VLS_styleScopedClasses === 'object' && !Array.isArray(__VLS_styleScopedClasses)) {
}
var __VLS_slots!: {};
// @ts-ignore
[$page, dashImageV, dashImageV, dashPrixV, dashNomV,];
return __VLS_slots;
}
const __VLS_internalComponent = (await import('vue')).defineComponent({
setup() {
return {
$props: __VLS_makeOptional(props),
...props,
AppLayout: AppLayout as typeof AppLayout,
};
},


let, id = 2,
methods: {
navigateToDetail(id) {
this.$inertia.visit(`/detail/${id}`);
},
navigateToDetailVehi(id) {
this.$inertia.visit(`/detailVehi/${id}`);
}
},
});
return (await import('vue')).defineComponent({
setup() {
return {
$props: __VLS_makeOptional(props),
...props,
};
},


let, id = 2,
methods: {
navigateToDetail(id) {
this.$inertia.visit(`/detail/${id}`);
},
navigateToDetailVehi(id) {
this.$inertia.visit(`/detailVehi/${id}`);
}
},
});
})();
