import{_ as p}from"./AppLayout-a1b50219.js";import c from"./DeleteUserForm-7eefc346.js";import l from"./LogoutOtherBrowserSessionsForm-9c06af12.js";import{S as s}from"./SectionBorder-9de859a7.js";import f from"./TwoFactorAuthenticationForm-67c0ff10.js";import u from"./UpdatePasswordForm-31e087d6.js";import d from"./UpdateProfileInformationForm-a4941583.js";import{c as _,w as n,o as e,a as i,d as r,b as t,e as a,F as h}from"./app-8596da2d.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./Modal-e1deae66.js";import"./SectionTitle-2ba90a86.js";import"./DangerButton-b6529035.js";import"./DialogModal-de533a14.js";import"./InputError-accd350c.js";import"./SecondaryButton-0f760498.js";import"./TextInput-ecb9bf03.js";import"./ActionMessage-afc23667.js";import"./PrimaryButton-2398beb5.js";import"./InputLabel-9d6abe1d.js";import"./FormSection-db5bf9f9.js";const g=i("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1),$={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},w={key:0},k={key:1},y={key:2},H={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(o,x)=>(e(),_(p,{title:"Profile"},{header:n(()=>[g]),default:n(()=>[i("div",null,[i("div",$,[o.$page.props.jetstream.canUpdateProfileInformation?(e(),r("div",w,[t(d,{user:o.$page.props.auth.user},null,8,["user"]),t(s)])):a("",!0),o.$page.props.jetstream.canUpdatePassword?(e(),r("div",k,[t(u,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),o.$page.props.jetstream.canManageTwoFactorAuthentication?(e(),r("div",y,[t(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(l,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),o.$page.props.jetstream.hasAccountDeletionFeatures?(e(),r(h,{key:3},[t(s),t(c,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{H as default};