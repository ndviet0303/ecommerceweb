import{g as b,h as v,a as k,c as a,b as t,F as w,x as T,C as h,o as n,t as r,l as B,m as V,v as I,d}from"./app-47f6bd4e.js";const N={class:"container m-auto"},$=t("h1",{class:"title"},"giỏ hàng",-1),q={key:0},D={class:"relative overflow-x-auto"},F={class:"w-full text-sm text-left text-gray-500"},H=t("thead",{class:"text-xs text-gray-700 uppercase bg-gray-50"},[t("tr",null,[t("th",{scope:"col",class:"px-6 py-3"}," tên sản phẩm "),t("th",{scope:"col",class:"px-6 py-3"}," đơn giá "),t("th",{scope:"col",class:"px-6 py-3"}," thời hạn "),t("th",{scope:"col",class:"px-6 py-3"}," số lượng "),t("th",{scope:"col",class:"px-6 py-3"}," thành tiền "),t("th",{scope:"col",class:"px-6 py-3"}," thao tác ")])],-1),S={scope:"row",class:"px-6 py-4 font-medium text-gray-900 whitespace-nowrap"},L={key:0,class:"px-6 py-4"},U={key:1,class:"px-6 py-4"},G={key:2,class:"px-6 py-4"},M={class:"px-6 py-4"},Q=["onUpdate:modelValue","onInput"],j={class:"px-6 py-4"},z={class:"px-6 py-4 boder-2"},A=["onClick"],E=["onClick"],P=["onClick"],X={key:1},O={__name:"cart",setup(J){const o=b(),l=v(()=>o.getters.getCartItems);function _(s){o.dispatch("addToCart",s)}function x(s){o.dispatch("reduceQuantityCartItem",s)}function m(s){o.dispatch("removeFromCart",s.id)}function y(s){o.dispatch("updateFromCart",s)}function u(s){return s.toLocaleString("vi-VN",{currency:"VND"})}function g(){o.dispatch("clearCart")}function f(){h.push({name:"Home"})}async function C(){const s=l.value;await axios.post("/api/paid",{postData:s},{headers:{Authorization:`Bearer ${o.state.token}`}}).then(c=>{c.data.message=="Success"&&o.dispatch("clearCart")}).catch(c=>{c.response&&c.response.status===401&&(o.dispatch("clearUser"),o.dispatch("clearToken"),h.push({name:"login"}))})}return(s,c)=>{const p=k("font-awesome-icon");return n(),a("div",N,[$,l.value.length>0?(n(),a("div",q,[t("div",D,[t("table",F,[H,t("tbody",null,[(n(!0),a(w,null,T(l.value,e=>(n(),a("tr",{class:"bg-white border-b",key:e.id},[t("th",S,r(e.product_name),1),e.product_price!=null?(n(),a("td",L,r(u(e.product_price))+" đ ",1)):B("",!0),e.product_type!=0?(n(),a("td",U,r(e.quantity+" "+e.expir),1)):(n(),a("td",G," Vĩnh Viễn ")),t("td",M,[V(t("input",{class:"max-w-[40px] boder-2",type:"number","onUpdate:modelValue":i=>e.quantity=i,onInput:i=>y(e)},null,40,Q),[[I,e.quantity]])]),t("td",j,r(u(e.quantity*e.product_price))+" đ ",1),t("td",z,[t("button",{class:"text-green-600 borderBox px-4 py-2",onClick:i=>_(e)},[d(p,{icon:["fas","plus"]})],8,A),t("button",{class:"text-orange-600 borderBox px-4 py-2",onClick:i=>x(e)},[d(p,{icon:["fas","minus"]})],8,E),t("button",{class:"text-red-600 borderBox px-4 py-2",onClick:i=>m(e)},[d(p,{icon:["fas","trash"]})],8,P)])]))),128))])]),t("div",{class:"mt-2 flex justify-end gap-5"},[t("button",{onClick:g,class:"text-white bg-red-600 p-2 rounded"},"Xoá Toàn Bộ Giỏ Hàng"),t("button",{onClick:f,class:"text-white bg-blue-600 p-2 rounded"},"Tiếp Tục Mua Hàng"),t("button",{onClick:C,class:"text-white bg-green-600 p-2 rounded"},"Thanh Toán")])])])):(n(),a("div",X," Giỏ Hàng Trống "))])}}};export{O as default};
