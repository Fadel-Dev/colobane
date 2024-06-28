<template>

<div class="container max-w-sm bg-gradient-to-b from-white to-[#F4F7FB] rounded-[40px] p-6 border-4 border-white shadow-[0_30px_30px_-20px_rgba(133,189,215,0.878)] m-5">
  <div class="heading text-center font-black text-[30px] text-[#1089D3]">Sign In</div>
  <form action="" class="form mt-5 space-y-4">
    <input required class="input w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#cff0ff] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-[#12B1D1]" type="email" name="email" id="email" placeholder="E-mail">
    <input required class="input w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#cff0ff] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-[#12B1D1]" type="password" name="password" id="password" placeholder="Password">
    <span class="forgot-password block mt-2 ml-2 text-xs text-[#0099ff]"><a href="#">Forgot Password ?</a></span>
    <input class="login-button block w-full font-bold bg-gradient-to-r from-[#1089D3] to-[#12B1D1] text-white py-4 mt-5 rounded-[20px] shadow-[0_20px_10px_-15px_rgba(133,189,215,0.878)] border-none transition-transform duration-200 ease-in-out transform hover:scale-105 active:scale-95" type="submit" value="Sign In">
  </form>
  <div class="social-account-container mt-6">
    <span class="title block text-center text-xs text-gray-500">Or Sign in with</span>
    <div class="social-accounts flex justify-center gap-4 mt-1">
      <button class="social-button bg-gradient-to-r from-black to-gray-500 border-4 border-white p-1.5 rounded-full w-10 h-10 flex items-center justify-center shadow-[0_12px_10px_-8px_rgba(133,189,215,0.878)] transition-transform duration-200 ease-in-out transform hover:scale-120 active:scale-90">
        <svg class="svg w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
          <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path>
        </svg>
      </button>
      <button class="social-button bg-gradient-to-r from-black to-gray-500 border-4 border-white p-1.5 rounded-full w-10 h-10 flex items-center justify-center shadow-[0_12px_10px_-8px_rgba(133,189,215,0.878)] transition-transform duration-200 ease-in-out transform hover:scale-120 active:scale-90">
        <svg class="svg w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
          <path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"></path>
        </svg>
      </button>
      <button class="social-button bg-gradient-to-r from-black to-gray-500 border-4 border-white p-1.5 rounded-full w-10 h-10 flex items-center justify-center shadow-[0_12px_10px_-8px_rgba(133,189,215,0.878)] transition-transform duration-200 ease-in-out transform hover:scale-120 active:scale-90">
        <svg class="svg w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
        </svg>
      </button>
    </div>
  </div>
  <span class="agreement block text-center mt-4"><a href="#" class="text-[#0099ff] text-xs">Learn user license agreement</a></span>
</div>

<!-- NEW FORM  -->
<form @submit.prevent="submit" class="py-5">
        <div class="bg-gray-100">
            <InputLabel for="email" value="Mail" />
            <TextInput
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="username"
            />
            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel for="password" value="Mots de passe" />
            <TextInput
                id="password"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="current-password"
            />
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <!-- <div class="block mt-4">
            <label class="flex items-center">
                <Checkbox v-model:checked="form.remember" name="remember" />
                <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
            </label>
        </div> -->

        <div class="flex items-center justify-between mt-4">
           <div class="flex-start">
            <label class="flex items-start">
                <Checkbox v-model:checked="form.remember" name="remember" />
                <span class="ml-2 text-sm text-gray-600  hover:text-principal ">Se souvenir de moi</span>
            </label>
           </div>

           <div class="flex-end">
            <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm hover:border-principal   hover:text-principal  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Mots de passe Oublie ?
            </Link>
           </div>
        </div>

        <!-- cccccccc -->

        <div class="flex items-center justify-center mt-4">


            <PrimaryButton class="ml-4 text-center bg-principal hover:border-2 hover:border-principal  hover:bg-secondaire hover:text-principal " :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Se connecter
            </PrimaryButton>
        </div>


    </form>

</template>