import{l as x,o,d as i,a as e,F as c,b as r,n as f,p as v,k as g,f as d,u as b,g as h,e as y,X as $,t as l}from"./app-8596da2d.js";import"./index-856adcff.js";import{_ as w}from"./_plugin-vue_export-helper-c27b6911.js";import{I as k}from"./index-1b393073.js";/* empty css                                                  */import j from"./SlidePub-e819f8d7.js";import B from"./Voiture-e92072a0.js";import S from"./Chambre-5129f7ec.js";/* empty css                                                                   */import O from"./Villa-5021ad4c.js";import T from"./Immeuble-da4d501b.js";import C from"./Terrain-4ba5ffb6.js";import V from"./Verger-a7cc4550.js";import{F as I}from"./Navbar.vue_vue_type_style_index_0_scoped_d5782124_lang-c8c96466.js";/* empty css                                               */const m=s=>(v("data-v-d5782124"),s=s(),g(),s),q={class:"bg-gray-100"},M={class:"w-full fixed top-0 left-0 z-10"},D={class:"px-11 py-5 mx-auto md:flex md:justify-between md:items-center shadow-xl bg-white text-principal"},P={class:"flex items-center justify-between"},z=["href"],A=["src"],N=m(()=>e("svg",{viewBox:"0 0 24 24",class:"w-12 h-12 fill-current"},[e("path",{d:"M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2z"})],-1)),F=[N],H={class:"hidden md:flex md:space-x-5 md:items-center"},L=["href"],W=m(()=>e("button",{class:"sign bg-principal"},[e("div",{class:"arrow-wrapper bg-principal text-principal"},[e("i",{class:"bi bi-plus"})]),d(" Publier une annonce ")],-1)),J=[W],R=["href"],U=["href"],E=["href"],X=["href"],G=["href"],K=m(()=>e("button",{class:"sign bg-principal"},[d(" Se connecter "),e("div",{class:"arrow-wrapper"},[e("div",{class:"arrow"})])],-1)),Q=[K],Y={"aria-labelledby":"header-navigation",class:"flex flex-col items-center"},Z={class:"flex flex-col space-y-4 px-4 py-2"},ee=["href"],se=["href"],te=["href"],oe=["href"],ie=["href"],ae=m(()=>e("button",{class:"sign"},[d(" Se connecter "),e("div",{class:"arrow-wrapper"},[e("div",{class:"arrow"})])],-1)),ne=[ae],re={data(){return{activeTab:"immobilier",showMenu:!1,marques:["tous","volvo","renault","peugeot","citroen","mitsubishi","bmw","audi","nissan","mercedes-benz","volkswagen","Toyota","ford","Jeep","autres"],selectedMarque:"dakar"}},methods:{navigateToDetail(s){this.$inertia.visit(`/detail/${s}`)}},mounted(){new Swiper(".swiper",{slidesPerView:"auto",spaceBetween:20,pagination:{el:".swiper-pagination",clickable:!0},autoplay:{delay:3e3,disableOnInteraction:!1}}),InertiaProgress.init({delay:200,color:"#eb2d53",includeCSS:!0,showSpinner:!0})}},le=Object.assign(re,{__name:"Navbar",props:{voitures:Object,maisons:Object,canLogin:Boolean,canRegister:Boolean,laravelVersion:String,phpVersion:String},setup(s){return(a,n)=>{const p=x("SwitchBtn");return o(),i("div",q,[e("nav",M,[e("div",D,[e("div",P,[e("a",{href:a.route("home")},[e("img",{width:" 100",class:"m-0 p-0",src:"/storage/slide/NoflayHub.png",alt:"Image logo"},null,8,A)],8,z),e("button",{onClick:n[0]||(n[0]=t=>a.showMenu=!a.showMenu),type:"button",class:"md:hidden text-secondaire hover:text-secondaire focus:outline-none absolute right-4 top-4"},F)]),e("div",H,[e("a",{href:a.route("publier"),class:"btn-secondary mx-[210px] text-principal"},J,8,L),a.$page.props.auth.user?(o(),i(c,{key:0},[e("a",{href:a.route("publier"),class:"btn-primary text-principal"},"Publier une annonce",8,R),e("a",{href:a.route("dashboard"),class:"btn-secondary"},"Dashboard",8,U)],64)):(o(),i(c,{key:1},[e("a",{href:a.route("publier"),class:"btn-primary"},"Accueil",8,E),e("a",{href:a.route("publier"),class:"btn-primary"},"Contact Us",8,X),r(p),e("a",{href:a.route("login"),class:"btn-secondary"},Q,8,G)],64))])]),e("div",{class:f([{block:a.showMenu,hidden:!a.showMenu},"md:hidden bg-secondaire text-white mt-4"])},[e("nav",Y,[e("ul",Z,[a.$page.props.auth.user?(o(),i(c,{key:0},[e("li",null,[e("a",{href:a.route("publier"),class:"btn-primary"},"Publier une annonce",8,ee)]),e("li",null,[e("a",{href:a.route("dashboard"),class:"btn-secondary"},"Dashboard",8,se)])],64)):(o(),i(c,{key:1},[e("li",null,[e("a",{href:a.route("publier"),class:"btn-primary"},"Accueil",8,te)]),e("li",null,[e("a",{href:a.route("publier"),class:"btn-primary"},"Contact Us",8,oe)]),e("li",null,[r(p)]),e("li",null,[e("a",{href:a.route("login"),class:"btn-secondary"},ne,8,ie)])],64))])])],2)])])}}}),ce=w(le,[["__scopeId","data-v-d5782124"]]);const u=s=>(v("data-v-ac15bee3"),s=s(),g(),s),de={id:"principal"},ue={class:"lg:w-8/12 mx-auto mx-0 px-0"},me={class:"mt-0"},pe={class:"swiper w-full lg:w-4/4 lg:mt-[10px]",id:"cat"},he={class:"swiper-wrapper pt-10"},_e=["onClick"],be={class:"text-center"},fe={class:"font-semibold text-secondaire"},ve={class:"lg:max-w-[80vw] max-w-[970vw] mx-auto mt-8"},ge={key:0,class:""},we={class:"swiper"},xe={class:"swiper-wrapper"},ye=["onClick"],$e={class:"card"},ke={class:"aspect-square overflow-hidden"},je=["src","alt"],Be={class:"absolute top-0 m-2 rounded-full"},Se={class:"rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3"},Oe={class:"my-2 mx-auto flex w-10/12 flex-col items-start justify-between"},Te={class:"mr-3 text-sm font-semibold text-principal align-center"},Ce=u(()=>e("span",{class:"text-secondaire mr-3"},"Fcfa",-1)),Ve={class:"mb-2 flex"},Ie={class:"mr-3 text-secondaire text-sm font-semibold truncate"},qe={class:"text-sm text-principal pt-[-8%] w-full border-b-[1px] border-gray-200"},Me=u(()=>e("button",{class:"bg-principal group mx-auto mt-[-10%] flex h-8 w-full items-stretch overflow-hidden hover:text-secondaire rounded-md text-white"},[e("div",{class:"flex w-full items-center justify-center bg-principal text-xs uppercase transition group-hover:text-secondaire"}," contacter")],-1)),De={class:"py-1 text-secondaire sm:py-16 lg:py-1",id:"transparent"},Pe={class:"mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8"},ze=u(()=>e("div",{class:"mx-auto max-w-md text-center"},[e("h2",{class:"font-serif text-2xl font-bold sm:text-2xl"},"Dernières Annonces au Sénégal ")],-1)),Ae={class:"mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4 sm:gap-4 lg:mt-16"},Ne=["onClick"],Fe={class:"card w-full"},He={class:"aspect-square overflow-hidden flex justify-center items-center"},Le=["src","alt"],We={class:"absolute top-0 m-2 rounded-full"},Je={class:"rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3"},Re={class:"my-2 mx-auto flex w-10/12 flex-col items-center justify-between"},Ue={class:"text-center text-sm font-semibold text-principal"},Ee=u(()=>e("span",{class:"text-secondaire mr-3"},"Fcfa",-1)),Xe={class:"mb-2 flex justify-center"},Ge={class:"text-secondaire text-sm font-semibold truncate"},Ke={class:"text-sm text-principal w-full border-b-[1px] border-gray-200 text-center"},Qe={key:0,class:"bg-principal group mx-auto mt-[-5%] flex h-8 w-full items-center justify-center rounded-md text-white"},Ye=u(()=>e("div",{class:"w-full flex justify-center"},[e("div",{class:"bg-principal text-xs uppercase transition group-hover:text-secondaire"}," Contacter ")],-1)),Ze=[Ye],es={key:1,class:"group mx-auto mt-[-10%] flex h-8 w-full items-center justify-center overflow-hidden rounded-md text-white"},ss={key:1,class:"bg-transparent"},ts={key:2,class:"bg-transparent"},os={key:3,class:"bg-transparent"},is={key:4,class:"bg-transparent"},as={key:5,class:"bg-transparent"},ns={key:6,class:"bg-transparent"},rs=u(()=>e("div",null,null,-1)),ls={class:"mt-20"},cs={data(){return{activeTab:"immobilier",showMenu:!1,marques:["tous","volvo","renault","peugeot","citroen","mitsubishi","bmw","audi","nissan","mercedes-benz","volkswagen","Toyota","ford","Jeep","autres"],selectedMarque:"dakar"}},methods:{navigateToDetail(s){this.$inertia.visit(`/detail/${s}`)}},mounted(){new Swiper(".swiper",{slidesPerView:"auto",spaceBetween:20,pagination:{el:".swiper-pagination",clickable:!0},autoplay:{delay:3e3,disableOnInteraction:!1}}),k.init({delay:200,color:"#eb2d53",includeCSS:!0,showSpinner:!0})}},ds=Object.assign(cs,{__name:"Welcome",props:{voitures:Object,voituresBoost:Object,immobilliersBoost:Object,maisons:Object,canLogin:Boolean,canRegister:Boolean,laravelVersion:String,phpVersion:String,chambres:Object,chambresBoost:Object,villas:Object,villasBoost:Object,immeubles:Object,immeublesBoost:Object,terrains:Object,terrainsBoost:Object,vergers:Object,vergersBoost:Object},setup(s){let a=[{id:1,icon:"home",name:"Villa"},{id:2,icon:"car",name:"Appartement"},{id:3,icon:"building",name:"Terrain"},{id:4,icon:"bed",name:"Chambre"},{id:5,icon:"building",name:"Immeuble"},{id:6,icon:"apple-alt",name:"Verger"},{id:7,icon:"car",name:"Vehicule"},{id:8,icon:"home",name:"Immobilier"}];return(n,p)=>(o(),i(c,null,[r(b($),{title:"Accueil"}),r(ce),e("div",de,[e("div",ue,[r(j),e("div",me,[e("div",pe,[e("div",he,[(o(!0),i(c,null,h(b(a),t=>(o(),i("div",{key:t.id,class:"swiper-slide w-1/4 sm:w-1/4 md:w-1/6 lg:w-6/6 xl:w-1/6 flex flex-col"},[e("div",{class:"text-center",onClick:_=>n.activeTab=t.name},[e("i",{class:f(`fas fa-${t.icon} text-3xl text-principal`)},null,2)],8,_e),e("div",be,[e("span",fe,l(t.name),1)])]))),128))])]),e("div",ve,[n.activeTab==="immobilier"?(o(),i("div",ge,[e("div",we,[e("div",xe,[(o(!0),i(c,null,h(s.immobilliersBoost.data,t=>(o(),i("div",{key:t.id,onClick:_=>n.navigateToDetail(t.id),class:"swiper-slide w-full sm:w-1/4 md:w-1/4 lg:w-1/6 xl:w-1/6 p-1"},[e("div",$e,[e("div",ke,[e("img",{src:"/storage/"+t.image1,alt:t.imageAlt,class:"h-full w-full object-cover transition-all duration-300 group-hover:scale-125"},null,8,je)]),e("div",Be,[e("p",Se,l(t.affaire),1)]),e("div",Oe,[e("p",Te,[d(l(t.prix)+" ",1),Ce]),e("div",Ve,[e("p",Ie,l(t.nom.substring(0,20)),1)]),e("h3",qe,l(t.region)+" ,Senegal ",1),d(" . ")]),Me])],8,ye))),128))]),e("section",De,[e("div",Pe,[ze,e("div",Ae,[(o(!0),i(c,null,h(s.maisons.data,t=>(o(),i("article",{key:t.id,onClick:_=>n.navigateToDetail(t.id),class:"relative flex flex-col overflow-hidden rounded-lg border justify-center items-center"},[e("div",Fe,[e("div",He,[e("img",{src:"/storage/"+t.image1,alt:t.imageAlt,class:"h-full w-full object-cover transition-all duration-300 group-hover:scale-125"},null,8,Le)]),e("div",We,[e("p",Je,l(t.affaire),1)]),e("div",Re,[e("p",Ue,[d(l(t.prix)+l(t.type)+" ",1),Ee]),e("div",Xe,[e("p",Ge,l(t.nom.substring(0,20)),1)]),e("h3",Ke,l(t.region)+", Senegal ",1)]),t.status=="accepter"?(o(),i("div",Qe,Ze)):(o(),i("div",es))])],8,Ne))),128))])])])])])):n.activeTab=="Vehicule"?(o(),i("div",ss,[r(B,{voitures:s.voitures,voituresBoost:s.voituresBoost,marques:n.marques},null,8,["voitures","voituresBoost","marques"])])):n.activeTab=="Chambre"?(o(),i("div",ts,[r(S,{chambres:s.chambres,chambresBoost:s.chambresBoost},null,8,["chambres","chambresBoost"])])):n.activeTab=="Villa"?(o(),i("div",os,[r(O,{villas:s.villas,villasBoost:s.villasBoost},null,8,["villas","villasBoost"])])):n.activeTab=="Immeuble"?(o(),i("div",is,[r(T,{immeubles:s.immeubles,immeublesBoost:s.immeublesBoost},null,8,["immeubles","immeublesBoost"])])):n.activeTab=="Terrain"?(o(),i("div",as,[r(C,{terrains:s.terrains,terrainsBoost:s.terrainsBoost},null,8,["terrains","terrainsBoost"])])):n.activeTab=="Verger"?(o(),i("div",ns,[r(V,{vergers:s.vergers,vergersBoost:s.vergersBoost},null,8,["vergers","vergersBoost"])])):y("",!0)])]),rs])]),e("div",ls,[r(I)])],64))}}),Bs=w(ds,[["__scopeId","data-v-ac15bee3"]]);export{Bs as default};