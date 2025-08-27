{{-- <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   @vite(['resources/css/register.css'])

</head>
<body>
   
<div class="form-container">
    <form method="POST" action="{{ route('register') }}" onsubmit="return validateEmail()">
        @csrf
      <h3>Register Now</h3>
      
      <input required placeholder="Enter your Name" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"> 
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
      {{-- <input required placeholder="Enter your Year Level" id="year_level" type="text" name="year_level" :value="old('year_level')" required autofocus autocomplete="year_level"> --}}
      <div>
         <select required placeholder="Select your Year Level" id="year_level" type="text" name="year_level" :value="old('year_level')" required="">
             <option value="">Select Year Level</option>
             <option value="1">1st Year</option>
             <option value="2">2nd Year</option>
             <option value="3">3rd Year</option>
             <option value="4">4th Year</option>
         </select>
     </div>
     <div>
        <select required placeholder="Select your Faculty" id="faculty" name="faculty">
            <option value="" disabled selected>Select your Faculty</option>
            @foreach($faculties as $faculty)
                <option value="{{ $faculty->value }}" {{ (isset($user) && $user->faculty->value == $faculty->value) ? 'selected' : '' }}>
                    {{ $faculty->label() }}
                </option>
            @endforeach
        </select>
    </div>
      <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
      <input required placeholder="Enter your ID Number" id="id_number" type="text" name="id_number" :value="old('id_number')" required autofocus autocomplete="id_number">   
      <x-input-error :messages="$errors->get('id_number')" class="mt-2" />   
      <input required placeholder="Enter your Email" id="email" type="email" name="email" :value="old('email')" required autocomplete="username">
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <p id="emailError" class="mt-2" style="color:red; display:none;">Use your University Email</p>
      <input required placeholder="Enter your Password"id="password" type="password" name="password" required autocomplete="new-password">
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
      <input required placeholder="Confirm your Password" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password">
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      <input type="submit" name="submit" value="{{ __('Register Now') }}" class="form-btn">
      <p>Already have an Account? <a href="{{ route('login') }}">login now</a></p>
   </form>

</div>

</body>
<script>
function validateEmail() {
   // var email = document.getElementById("email").value;
    // var regex = /^[a-zA-Z0-9._%+-]+@infosoft\.com\.ph$/;

    // if (!regex.test(email)) {
    //     document.getElementById("emailError").style.display = 'block';
    //     return false;
    // } else {
    //     document.getElementById("emailError").style.display = 'none';
    //     return true;
    // }
    return true;
}
</script>
    
</html>
 --}}



 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>
 
    <!-- custom css file link  -->
    @vite(['resources/css/register.css'])
 
    <style>
        .conditional-fields {
            display: none; /* Initially hide the conditional fields */
        }
    </style>
 </head>
 <body>
    
 <div class="form-container">
     <form method="POST" action="{{ route('register') }}" onsubmit="return validateEmail()">
         @csrf
         <h3>Register Now</h3>
         
         <input required placeholder="Enter your Name" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"> 
         <x-input-error :messages="$errors->get('name')" class="mt-2" />
         
        
 
         <input required placeholder="Enter your Email" id="email" type="email" name="email" :value="old('email')" required autocomplete="username" oninput="checkEmail()">
         <x-input-error :messages="$errors->get('email')" class="mt-2" />
         
          <div id="conditionalFields" class="conditional-fields">
             <select placeholder="Enter your Year Level" id="year_level" name="year_level" :value="old('year_level')">
                 <option value="">Select Year Level</option>
                 <option value="1">1st Year</option>
                 <option value="2">2nd Year</option>
                 <option value="3">3rd Year</option>
                 <option value="4">4th Year</option>
             </select>
             <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
             <div>
                 <select placeholder="Select your Faculty" id="faculty" name="faculty">
                     <option value="" disabled selected>Select your Faculty</option>
                     @foreach($faculties as $faculty)
                         <option value="{{ $faculty->value }}" {{ (isset($user) && $user->faculty->value == $faculty->value) ? 'selected' : '' }}>
                             {{ $faculty->label() }}
                         </option>
                     @endforeach
                 </select>
                 <x-input-error :messages="$errors->get('faculty')" class="mt-2" />
             </div>
             <input placeholder="Enter your ID Number" id="id_number" type="text" name="id_number" :value="old('id_number')">   
             <x-input-error :messages="$errors->get('id_number')" class="mt-2" />   
         </div>
         
         <input required placeholder="Enter your Password" id="password" type="password" name="password" required autocomplete="new-password">
         <x-input-error :messages="$errors->get('password')" class="mt-2" />
         
         <input required placeholder="Confirm your Password" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password">
         <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
         
         <input type="submit" name="submit" value="{{ __('Register Now') }}" class="form-btn">
         <p>Already have an Account? <a href="{{ route('login') }}">login now</a></p>
     </form>
 </div>
 
 </body>
 <script>
 function checkEmail() {
     var email = document.getElementById("email").value;
     var regex = /^[a-zA-Z0-9._%+-]+@dorsu\.edu\.ph$/;
 
     if (regex.test(email)) {
         document.getElementById("conditionalFields").style.display = 'block'; // Show fields
         document.getElementById("emailError").style.display = 'none'; // Hide error
     } else {
         document.getElementById("conditionalFields").style.display = 'none'; // Hide fields
         document.getElementById("emailError").style.display = 'block'; // Show error
     }
 }
 
 function validateEmail() {
     // Ensure the email is valid before submitting
     var email = document.getElementById("email").value;
     var regex = /^[a-zA-Z0-9._%+-]+@dorsu\.edu\.ph$/;
 
     if (!regex.test(email)) {
         document.getElementById("emailError").style.display = 'block';
         return false;
     }
     return true;
 }
 </script>
     
 </html>
 
 