import{f as g,_ as y,u as w,g as k,h as f,r as T,i as S,a as x,o as d,c as u,b as e,d as t,j as r,w as l,t as v,k as C,l as j,m as z,v as A,p as N,n as p,e as H}from"./app-47f6bd4e.js";g.defaults.withCredentials=!0;const U={setup(){const c=w(),s=k(),_=f(()=>s.getters.getUserData),o=f(()=>s.getters.isAuthenticated),b=f(()=>s.getters.cartItemCount),m=T("");function a(){c.push({name:"search",params:{name:m.value}})}const n=async()=>{o.value&&g.post("/api/logout",{},{headers:{Authorization:`Bearer ${s.state.token}`}}).then(h=>{s.dispatch("clearUser"),s.dispatch("clearToken"),c.push("/login")}).catch(h=>{})};return S(async()=>{o.value&&await g.post("/api/user",{},{headers:{Authorization:`Bearer ${s.state.token}`}}).then(h=>{s.dispatch("setUser",h.data.user)}).catch(()=>{s.dispatch("clearUser"),s.dispatch("clearToken")})}),{user:_,isAuthorized:o,logout:n,cartItemCount:b,SendSearch:a,nameTool:m}},computed:{currentRouteName(){return this.$route.name}}},V={class:"header-section"},B={class:"header-top"},D={class:"container m-auto"},R={class:"flex flex-row justify-around"},F={class:"flex flex-row"},I={href:"mailto:contact@ziet.dev",class:"py-4 pr-5 line-space-right"},K={href:"tel:+84345694088",class:"py-4 pl-5"},L={class:"items-end flex"},M={class:"top-social line-space-right pr-5 gap-2 flex py-4"},P={href:"#"},$={href:"https://github.com/ndviet0303"},q={href:"https://t.me/+84345694088"},E={key:0,class:"flex"},G={key:1,class:"dropdown pl-5 pr-5 py-4"},O={class:"dropdown-content capitalize"},J=e("span",null,"Admin",-1),Q={class:"header-mid w-full"},W={class:"container py-10 flex flex-row flex-wrap justify-between m-auto"},X={class:"flex-1 text-center justify-center"},Y={class:"flex h-full items-center justify-center"},Z=e("p",{class:"text-5xl"},"Logo",-1),ee={class:"flex-auto"},te={class:"relative"},se={class:"absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"},oe={class:"flex-1 text-center"},ae={class:"bg-gray-800 border-gray-700"},ne={class:"max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"},re={"data-collapse-toggle":"navbar-solid-bg",type:"button",class:"inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600","aria-controls":"navbar-solid-bg","aria-expanded":"false"},le=e("span",{class:"sr-only"},"Open main menu",-1),ie={class:"hidden w-full md:block md:w-auto",id:"navbar-solid-bg"},ce={class:"flex flex-col font-medium mt-4 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 bg-gray-800 md:bg-transparent border-gray-700"};function de(c,s,_,o,b,m){const a=x("font-awesome-icon"),n=x("router-link");return d(),u("header",V,[e("div",B,[e("div",D,[e("div",R,[e("div",F,[e("a",I,[t(a,{icon:["fas","envelope"]}),r(" contact@ziet.dev ")]),e("a",K,[t(a,{icon:["fas","phone"]}),r(" +84 3456.940.88 ")])]),e("div",L,[e("div",M,[e("a",P,[t(a,{icon:["fab","facebook"]})]),e("a",$,[t(a,{icon:["fab","github"]})]),e("a",q,[t(a,{icon:["fab","telegram"]})])]),o.isAuthorized?(d(),u("div",G,[e("button",null,[r(v(o.user.name+" "+o.user.cash.toLocaleString()+"đ "),1),t(a,{icon:["fas","caret-down"]})]),e("div",O,[o.user.user_role>=2?(d(),C(n,{key:0,to:{name:"admin.dashboard"}},{default:l(()=>[J]),_:1},8,["to"])):j("",!0),t(n,{to:{name:"information"}},{default:l(()=>[r("tT tài khoản")]),_:1}),t(n,{to:{name:"license"}},{default:l(()=>[r("license")]),_:1}),t(n,{to:{name:"changepass"}},{default:l(()=>[r("đổi mật khẩu")]),_:1}),e("a",{href:"#",onClick:s[0]||(s[0]=(...i)=>o.logout&&o.logout(...i))},"đăng xuất")])])):(d(),u("div",E,[t(n,{to:{name:"login"},class:"login-panel pl-5 flex gap-2 items-center line-space-right pr-5 py-4"},{default:l(()=>[t(a,{icon:["fas","user"]}),r(" Đăng Nhập")]),_:1}),t(n,{to:{name:"register"},class:"login-panel pl-5 flex gap-2 items-center line-space-right pr-5 py-4"},{default:l(()=>[t(a,{icon:["fas","user-plus"]}),r(" Đăng Ký ")]),_:1})]))])])])]),e("div",Q,[e("div",W,[e("div",X,[e("div",Y,[t(n,{to:{name:"Home"}},{default:l(()=>[Z]),_:1})])]),e("div",ee,[e("div",te,[e("div",se,[t(a,{icon:["fas","magnifying-glass"]})]),z(e("input",{type:"search",id:"default-search","onUpdate:modelValue":s[1]||(s[1]=i=>o.nameTool=i),class:"block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none",placeholder:"Tìm Tên Tool",required:"",onKeyup:s[2]||(s[2]=N((...i)=>o.SendSearch&&o.SendSearch(...i),["enter"]))},null,544),[[A,o.nameTool]]),e("button",{type:"submit",onClick:s[3]||(s[3]=(...i)=>o.SendSearch&&o.SendSearch(...i)),class:"text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"},"Tìm")])]),e("div",oe,[t(n,{to:{name:"cart"},class:"flex h-full items-center justify-center",href:"#"},{default:l(()=>[t(a,{icon:["fas","cart-shopping"]}),e("span",null,"Giỏ Hàng Hiện Có :"+v(o.cartItemCount),1)]),_:1})])])]),e("nav",ae,[e("div",ne,[e("button",re,[le,t(a,{icon:["fas","bars"]})]),e("div",ie,[e("ul",ce,[e("li",null,[t(n,{to:{name:"Home"},class:p(["block py-2 pl-3 pr-4 text-white rounded md:p-0 md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent",{"md:text-blue-500 bg-blue-600 md:bg-transparent":c.$route.name==="Home"}])},{default:l(()=>[r("Trang Chủ")]),_:1},8,["class"])]),e("li",null,[t(n,{to:{name:"products"},class:p(["block py-2 pl-3 pr-4 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent",{"md:text-blue-500 bg-blue-600 md:bg-transparent":c.$route.name==="products"}])},{default:l(()=>[r("Tool")]),_:1},8,["class"])]),e("li",null,[t(n,{to:{name:"deposit"},class:p(["block py-2 pl-3 pr-4 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent",{"md:text-blue-500 bg-blue-600 md:bg-transparent":c.$route.name==="deposit"}])},{default:l(()=>[r("Nạp Tiền")]),_:1},8,["class"])])])])])])])}const _e=y(U,[["render",de]]),ue={},me={class:"bg-white shadow dark:bg-gray-800 inset-x-0 bottom-0"},he=H('<div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between"><span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved. </span><ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0"><li><a href="#" class="mr-4 hover:underline md:mr-6">About</a></li><li><a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a></li><li><a href="#" class="mr-4 hover:underline md:mr-6">Licensing</a></li><li><a href="#" class="hover:underline">Contact</a></li></ul></div>',1),fe=[he];function pe(c,s){return d(),u("footer",me,fe)}const be=y(ue,[["render",pe]]);export{be as F,_e as H};