import{v as x,d as p,b as t,w as i,u as s,a as e,F as b,X as g,o as m,s as f,t as y,e as _,m as v,h as d,q as c,f as u,n as k,l as V}from"./app-d028698b.js";import{A as N}from"./AuthenticationCard-d25cc0a8.js";import{_ as q}from"./Checkbox-482a15ca.js";import{_ as l}from"./InputError-dc20b5ff.js";import{_ as S}from"./InputLabel-9c2f6b21.js";import{_ as C}from"./PrimaryButton-debe7b35.js";import{N as U}from"./Navbar-ed062e76.js";import"./_plugin-vue_export-helper-c27b6911.js";const j=e("title",null,"S inscrire",-1),T={class:"main max-h-1/4"},$={class:"min-w-screen min-h-screen bg-secondaire flex items-center justify-center px-5 py-5"},F={class:"bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden",style:{"max-width":"1000px"}},M={class:"md:flex w-full h-screen",id:"main"},P=e("div",{class:"hidden md:block w-1/2 bg-indigo-500 h-full",id:"pic"},null,-1),A={class:"w-full md:w-1/2 py-5 px-5 md:px-10"},B=["src"],D={key:0,class:"mb-4 font-medium text-sm text-green-600"},z=["onSubmit"],E={class:"lg:grid grid-cols-7 gap-2"},H={class:"col-span-3"},I={class:"col-span-4"},R={class:"mt-4"},O={class:"mt-4"},X={key:0,class:"mt-4"},G={class:"flex items-center"},J={class:"ml-2"},K=["href"],L=["href"],Q={class:"text-center"},W={class:"w-full"},Y={class:"mt-2"},Z=e("span",{class:"text-principal hover:underline"}," Se connecter",-1),ee={components:{Head:g}},ce=Object.assign(ee,{__name:"Register",setup(se){const o=x({name:"",email:"",phone:"",password:"",password_confirmation:"",terms:!1}),h=()=>{o.post(route("register"),{onFinish:()=>o.reset("password","password_confirmation")})};return(a,r)=>{const w=V("router-link");return m(),p(b,null,[t(s(g),null,{default:i(()=>[j]),_:1}),e("header",null,[t(U)]),e("div",T,[e("div",$,[e("div",F,[e("div",M,[P,e("div",A,[t(N,null,{default:i(()=>[t(s(f),{href:"/"},{default:i(()=>[t(w,{to:"/publier",class:"text-2xl text-principal"}),e("img",{class:"w-2/4 mx-auto lg:mx-auto mx-auto lg:mx-0 p-1",src:"/storage/slide/NoflayHub.png",alt:"Image logo"},null,8,B)]),_:1}),a.status?(m(),p("div",D,y(a.status),1)):_("",!0),e("form",{onSubmit:v(h,["prevent"])},[e("div",null,[d(e("input",{id:"name","onUpdate:modelValue":r[0]||(r[0]=n=>s(o).name=n),type:"text",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",required:"",autofocus:"",placeholder:"Votre Nom",autocomplete:"name"},null,512),[[c,s(o).name]]),t(l,{class:"mt-2",message:s(o).errors.name},null,8,["message"])]),e("div",E,[e("div",H,[d(e("input",{id:"phone","onUpdate:modelValue":r[1]||(r[1]=n=>s(o).phone=n),type:"number",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",placeholder:"Votre Telephone",required:"",autofocus:"",autocomplete:"phone"},null,512),[[c,s(o).phone]]),t(l,{class:"mt-2",message:s(o).errors.phone},null,8,["message"])]),e("div",I,[d(e("input",{id:"email","onUpdate:modelValue":r[2]||(r[2]=n=>s(o).email=n),type:"email",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",required:"",placeholder:"Votre Mail",autocomplete:"username"},null,512),[[c,s(o).email]]),t(l,{class:"mt-2",message:s(o).errors.email},null,8,["message"])])]),e("div",R,[d(e("input",{id:"password","onUpdate:modelValue":r[3]||(r[3]=n=>s(o).password=n),type:"password",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",required:"",placeholder:"Votre Mots de passe",autocomplete:"new-password"},null,512),[[c,s(o).password]]),t(l,{class:"mt-2",message:s(o).errors.password},null,8,["message"])]),e("div",O,[d(e("input",{id:"password_confirmation","onUpdate:modelValue":r[4]||(r[4]=n=>s(o).password_confirmation=n),type:"password",class:"w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50",required:"",placeholder:"Entrez a Nouveau",autocomplete:"new-password"},null,512),[[c,s(o).password_confirmation]]),t(l,{class:"mt-2",message:s(o).errors.password_confirmation},null,8,["message"])]),a.$page.props.jetstream.hasTermsAndPrivacyPolicyFeature?(m(),p("div",X,[t(S,{for:"terms"},{default:i(()=>[e("div",G,[t(q,{id:"terms",checked:s(o).terms,"onUpdate:checked":r[5]||(r[5]=n=>s(o).terms=n),name:"terms",required:""},null,8,["checked"]),e("div",J,[u(" I agree to the "),e("a",{target:"_blank",href:a.route("terms.show"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},"Terms of Service",8,K),u(" and "),e("a",{target:"_blank",href:a.route("policy.show"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},"Privacy Policy",8,L)])]),t(l,{class:"mt-2",message:s(o).errors.terms},null,8,["message"])]),_:1})])):_("",!0),e("div",Q,[e("div",W,[t(C,{class:k(["login-button justify-center block w-full font-bold bg-gradient-to-r from-[#eb2d53] to-[#101634] text-white py-4 mt-5 rounded-[50px] shadow-[0_20px_10px_-15px_rgba(133,189,215,0.878)] border-none transition-transform duration-200 ease-in-out transform hover:scale-105 active:scale-95 text-center bg-principal hover:bg-secondaire",{"opacity-25":s(o).processing}]),disabled:s(o).processing},{default:i(()=>[u(" S inscrire ")]),_:1},8,["class","disabled"])]),e("div",Y,[t(s(f),{href:a.route("login"),class:"text-sm text-gray-600 hover:text-principal rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:i(()=>[u(" Deja un Compte ? "),Z]),_:1},8,["href"])])])],40,z)]),_:1})])])])])])],64)}}});export{ce as default};