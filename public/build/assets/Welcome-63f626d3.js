import{d as i,b as r,u as p,a as e,F as c,g as d,e as v,o,X as h,n as f,t as l,f as m,p as b,k as g}from"./app-d028698b.js";import"./index-c96ab2fd.js";import{_ as x}from"./_plugin-vue_export-helper-c27b6911.js";import{I as w}from"./index-18d242f6.js";/* empty css                                                  */import y from"./SlidePub-76d4839e.js";import j from"./Voiture-93319f59.js";import k from"./Chambre-664bc7a4.js";/* empty css                                                                   */import B from"./Villa-2970ff04.js";import O from"./Immeuble-a2ae085d.js";import T from"./Terrain-0a4478e4.js";import S from"./Verger-ec7e567f.js";import{F as V}from"./Footer-0deec15b.js";import{N as C}from"./Navbar-ed062e76.js";/* empty css                                               */const n=s=>(b("data-v-585c466d"),s=s(),g(),s),$={id:"principal"},I={class:"lg:w-8/12 mx-auto mx-0 px-0"},q={class:"mt-0"},F={class:"swiper w-full lg:w-4/4 lg:mt-[10px]",id:"cat"},N={class:"swiper-wrapper pt-10"},A=["onClick"],D={class:"text-center"},P={class:"font-semibold text-secondaire"},W={class:"lg:max-w-[80vw] max-w-[970vw] mx-auto mt-8"},z={key:0,class:""},L={class:"swiper"},M={class:"swiper-wrapper"},E=["onClick"],J={class:"card"},R={class:"aspect-square overflow-hidden"},X=["src","alt"],G={class:"absolute top-0 m-2 rounded-full"},H={class:"rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3"},K={class:"my-2 mx-auto flex w-10/12 flex-col items-start justify-between"},Q={class:"mr-3 text-sm font-semibold text-principal align-center"},U=n(()=>e("span",{class:"text-secondaire mr-3"},"Fcfa",-1)),Y={class:"mb-2 flex"},Z={class:"mr-3 text-secondaire text-sm font-semibold truncate"},ee={class:"text-sm text-principal pt-[-8%] w-full border-b-[1px] border-gray-200"},te=n(()=>e("button",{class:"bg-principal group mx-auto mt-[-10%] flex h-8 w-full items-stretch overflow-hidden hover:text-secondaire rounded-md text-white"},[e("div",{class:"flex w-full items-center justify-center bg-principal text-xs uppercase transition group-hover:text-secondaire"}," contacter")],-1)),se={class:"py-1 text-secondaire sm:py-16 lg:py-1",id:"transparent"},ie={class:"mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8"},oe=n(()=>e("div",{class:"mx-auto max-w-md text-center"},[e("h2",{class:"font-serif text-2xl font-bold sm:text-2xl"},"Dernières Annonces au Sénégal ")],-1)),ae={class:"mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4 sm:gap-4 lg:mt-16"},re=["onClick"],le={class:"card w-full"},ne={class:"aspect-square overflow-hidden flex justify-center items-center"},ce=["src","alt"],de={class:"absolute top-0 m-2 rounded-full"},me={class:"rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3"},ue={class:"my-2 mx-auto flex w-10/12 flex-col items-center justify-between"},pe={class:"text-center text-sm font-semibold text-principal"},_e=n(()=>e("span",{class:"text-secondaire mr-3"},"Fcfa",-1)),ve={class:"mb-2 flex justify-center"},he={class:"text-secondaire text-sm font-semibold truncate"},fe={class:"text-sm text-principal w-full border-b-[1px] border-gray-200 text-center"},be={key:0,class:"bg-principal group mx-auto mt-[-5%] flex h-8 w-full items-center justify-center rounded-md text-white"},ge=n(()=>e("div",{class:"w-full flex justify-center"},[e("div",{class:"bg-principal text-xs uppercase transition group-hover:text-secondaire"}," Contacter ")],-1)),xe=[ge],we={key:1,class:"group mx-auto mt-[-10%] flex h-8 w-full items-center justify-center overflow-hidden rounded-md text-white"},ye={key:1,id:"VoitureSection",class:"bg-transparent"},je={key:2,id:"maisons",class:"bg-transparent"},ke={key:3,class:"bg-transparent"},Be={key:4,class:"bg-transparent"},Oe={key:5,class:"bg-transparent"},Te={key:6,class:"bg-transparent"},Se=n(()=>e("div",null,null,-1)),Ve={class:"mt-20"},Ce={data(){return{activeTab:"immobilier",showMenu:!1,marques:["tous","volvo","renault","peugeot","citroen","mitsubishi","bmw","audi","nissan","mercedes-benz","volkswagen","Toyota","ford","Jeep","autres"],selectedMarque:"dakar"}},methods:{navigateToDetail(s){this.$inertia.visit(`/detail/${s}`)}},mounted(){new Swiper(".swiper",{slidesPerView:"auto",spaceBetween:20,pagination:{el:".swiper-pagination",clickable:!0},autoplay:{delay:3e3,disableOnInteraction:!1}}),w.init({delay:200,color:"#eb2d53",includeCSS:!0,showSpinner:!0})}},$e=Object.assign(Ce,{__name:"Welcome",props:{voitures:Object,voituresBoost:Object,immobilliersBoost:Object,maisons:Object,canLogin:Boolean,canRegister:Boolean,laravelVersion:String,phpVersion:String,chambres:Object,chambresBoost:Object,villas:Object,villasBoost:Object,immeubles:Object,immeublesBoost:Object,terrains:Object,terrainsBoost:Object,vergers:Object,vergersBoost:Object},setup(s){let _=[{id:1,icon:"home",name:"Villa"},{id:2,icon:"car",name:"Appartement"},{id:3,icon:"building",name:"Terrain"},{id:4,icon:"bed",name:"Chambre"},{id:5,icon:"building",name:"Immeuble"},{id:6,icon:"apple-alt",name:"Verger"},{id:7,icon:"car",name:"Vehicule"},{id:8,icon:"home",name:"Immobilier"}];return(a,Ie)=>(o(),i(c,null,[r(p(h),{title:"Accueil"}),r(C,{class:"relative"}),e("div",$,[e("div",I,[r(y),e("div",q,[e("div",F,[e("div",N,[(o(!0),i(c,null,d(p(_),t=>(o(),i("div",{key:t.id,class:"swiper-slide w-1/4 sm:w-1/4 md:w-1/6 lg:w-6/6 xl:w-1/6 flex flex-col"},[e("div",{id:"{{ item.id }}",class:"text-center",onClick:u=>a.activeTab=t.name},[e("i",{class:f(`fas fa-${t.icon} text-3xl text-principal`)},null,2)],8,A),e("div",D,[e("span",P,l(t.name),1)])]))),128))])]),e("div",W,[a.activeTab==="immobilier"?(o(),i("div",z,[e("div",L,[e("div",M,[(o(!0),i(c,null,d(s.immobilliersBoost.data,t=>(o(),i("div",{key:t.id,onClick:u=>a.navigateToDetail(t.id),class:"swiper-slide w-full sm:w-1/4 md:w-1/4 lg:w-1/6 xl:w-1/6 p-1"},[e("div",J,[e("div",R,[e("img",{src:"/storage/"+t.image1,alt:t.imageAlt,class:"h-full w-full object-cover transition-all duration-300 group-hover:scale-125"},null,8,X)]),e("div",G,[e("p",H,l(t.affaire),1)]),e("div",K,[e("p",Q,[m(l(t.prix)+" ",1),U]),e("div",Y,[e("p",Z,l(t.nom.substring(0,20)),1)]),e("h3",ee,l(t.region)+" ,Senegal ",1),m(" . ")]),te])],8,E))),128))]),e("section",se,[e("div",ie,[oe,e("div",ae,[(o(!0),i(c,null,d(s.maisons.data,t=>(o(),i("article",{key:t.id,onClick:u=>a.navigateToDetail(t.id),class:"relative flex flex-col overflow-hidden rounded-lg border justify-center items-center"},[e("div",le,[e("div",ne,[e("img",{src:"/storage/"+t.image1,alt:t.imageAlt,class:"h-full w-full object-cover transition-all duration-300 group-hover:scale-125"},null,8,ce)]),e("div",de,[e("p",me,l(t.affaire),1)]),e("div",ue,[e("p",pe,[m(l(t.prix)+l(t.type)+" ",1),_e]),e("div",ve,[e("p",he,l(t.nom.substring(0,20)),1)]),e("h3",fe,l(t.region)+", Senegal ",1)]),t.status=="accepter"?(o(),i("div",be,xe)):(o(),i("div",we))])],8,re))),128))])])])])])):a.activeTab=="Vehicule"?(o(),i("div",ye,[r(j,{voitures:s.voitures,voituresBoost:s.voituresBoost,marques:a.marques},null,8,["voitures","voituresBoost","marques"])])):a.activeTab=="Chambre"?(o(),i("div",je,[r(k,{chambres:s.chambres,chambresBoost:s.chambresBoost},null,8,["chambres","chambresBoost"])])):a.activeTab=="Villa"?(o(),i("div",ke,[r(B,{villas:s.villas,villasBoost:s.villasBoost},null,8,["villas","villasBoost"])])):a.activeTab=="Immeuble"?(o(),i("div",Be,[r(O,{immeubles:s.immeubles,immeublesBoost:s.immeublesBoost},null,8,["immeubles","immeublesBoost"])])):a.activeTab=="Terrain"?(o(),i("div",Oe,[r(T,{terrains:s.terrains,terrainsBoost:s.terrainsBoost},null,8,["terrains","terrainsBoost"])])):a.activeTab=="Verger"?(o(),i("div",Te,[r(S,{vergers:s.vergers,vergersBoost:s.vergersBoost},null,8,["vergers","vergersBoost"])])):v("",!0)])]),Se]),e("div",Ve,[r(V)])])],64))}}),Ke=x($e,[["__scopeId","data-v-585c466d"]]);export{Ke as default};