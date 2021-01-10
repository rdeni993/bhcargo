<!-- Header -->
<?php echo $header; ?>

<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <div class="container web-content" id="mainVueApp">
        <?php if(@$statusCode): ?>
            <?php if($statusCode == 200): ?>
                <div class="alert-box box-success py-80">
                    <div class="box-content">
                        <h3>Hvala Vam na povjerenju!</h3>
                        <p>Vaš nalog je uspješno kreiran i od sada ste član BHCargo tima. Prije nego što počnete koristiti usluge 
                            našeg servisa morate potvrditi Vaš nalog kodom koji ste dobili na upisani E-mail!
                        </p>
			<p>Obavezno provjeriti Vaš odjeljak za spam poruke! Ponekad mailovi znaju tamo zalutati!</p>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('login'); ?>">Prijavi se na nalog</a>
                    </div>
                </div>
            <?php elseif($statusCode == 404): ?>
                <div class="alert-box box-error py-80">
                    <div class="box-content">
                        <h3>Nalog nije kreiran!</h3>
                        <p>Koristeći Vaše upisane podatke nismo mogli kreirati Vaš nalog.</p>
                        <p>S obzirom da vidite ovu poruku obratite pažnju na nekoliko stvari:</p>
                        <ol>
                            <li>Ako Vam je u Browser isključen Javascript uključite ga. JS će Vam pomoći prilikom registrovanja naloga!</li>
                            <li>Ako niste unijeli sve podatke unesite ih. Profil Vas predstavlja na našem servisu i svi podaci su jako bitni! PS. 
                                Prije svega pročitajte naše Uslove i pravila korištenja servisa.
                            </li>
                            <li>Lozinka mora biti duža od 8 karaktera i odgovarati lozinki u polju dva</li>
                            <li>Korinički podaci moraju biti jedinstveni</li>
                            <li>Provjeri podatke vezane za firmu!</li>
                        </ol>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('register'); ?>">Pokusaj opet</a>
                    </div>
                </div>
            <?php elseif($statusCode == 904): ?>
                <div class="alert-box box-error py-80">
                    <div class="box-content">
                        <h3>Nalog nije potvrđen!</h3>
                        <p>Koristeći Vaše upisane podatke nismo mogli potvrditi Vaš nalog.</p>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('register'); ?>">Pokusaj opet</a>
                    </div>
                </div>
            <?php elseif($statusCode == 900): ?>
                <div class="alert-box box-success py-80">
                    <div class="box-content">
                        <h3>Nalog je aktiviran!</h3>
                        <p>Odsada možete koristiti sve mogućnosti servisa BH Cargo!</p>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('login'); ?>">Prijavi se</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
        <form @submit.prevent="submitForm" ref="regForm" action="<?php echo site_url('register/do_reg'); ?>" method="POST">

        <div class="row">
            <div class="col-lg-12 py-80">
                <h4 class="pb-3">Postani dio tima</h4>

                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="py-3">Privatni podaci</h5>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" v-model="formData.name" name="name" class="def-input" placeholder="Ime" />
                            <small v-if="formData.nameStatus" class="text-error">{{formData.nameStatus}}</small>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" v-model="formData.surname" name="surname" class="def-input" placeholder="Prezime" />
                            <small v-if="formData.surnameStatus" class="text-error">{{formData.surnameStatus}}</small>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" v-model="formData.phone" name="phone" class="def-input" placeholder="Broj telefona" />
                            <small v-if="formData.phoneStatus" class="text-error">{{formData.phoneStatus}}</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="py-3">Podaci o računu</h5>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="email" @blur="checkEmail" v-model="formData.email" name="email" class="def-input" placeholder="E-pošta" />
                            <small class="text-error" v-if="formData.emailStatus">{{formData.emailStatus}}</small>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="password" @blur="checkPassword" v-model="formData.password" name="password" class="def-input" placeholder="Lozinka" />
                            <small v-if="formData.passwordStatus" class="text-error">{{formData.passwordStatus}}</small>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="password" @blur="checkPasswordMatch" v-model="formData.repeatedPassword" name="repeated_password" class="def-input" placeholder="Ponovi lozinku" />
                            <small v-if="formData.repeatedPasswordStatus">{{formData.repeatedPasswordStatus}}</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="py-3">Podaci o kompaniji</h5>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" name="cmp_name" class="def-input" placeholder="npr. BH Cargo" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" name="cmp_addr" class="def-input" placeholder="naziv ulice, grad, poštanski broj" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <select name="cmp_type" class="def-input">
                                <option value="0" disabled selected>--Izaberi--</option>
                                <?php if($cmpTypes): ?>
                                    <?php foreach($cmpTypes as $cmp): ?>
                                        <option value="<?php echo $cmp->id; ?>"><?php echo $cmp->company_type; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="checkbox" v-model="agreeContract" name="agreed_services" class="mr-2">
                        <small>Pročitao sam <a target="_blank" href="<?php echo site_url('about#privacy'); ?>">Pravila i uslove korištenja aplikacije</a>! Slažem se sa pročitanim
                             <br>uslovima i siguran sam da 
                            želim izraditi profil na Vašoj stranici!
                        </small>
                    </div>
                    <div class="col-lg-12">
                        <button @click.prevent="checkForm" v-if="!readyToComplete" class="def-agree-btn" :disabled="!agreeContract">Provjeri</button>
                        <button v-else class="def-agree-btn"><i class="fa fa-check text-success"></i> Izradi nalog</button>
                        <div>
                        <small v-if="checkStatus">Postoji {{regFormErrors}} grešaka nastalih prilikom popunjavanja formulara.
                        Pregledajte formular i ispravite greške.</small>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        </form>
        <?php endif; ?>
    </div>

</div>
<!-- EOF: Template -->

<script type='text/javascript' src='<?php echo base_url(); ?>/public/assets/js/vue.js?ver=5.5.1'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>/public/assets/js/axios.js?ver=5.5.1'></script>
<script>
    const vueApp = new Vue({
        el      : "#mainVueApp",
        data    : {
            readyToComplete : false,
            regFormErrors : 0,
            checkStatus : false,
            agreeContract : false,
            formData : {
                password : null,
                passwordStatus : null,
                repeatedPassword : null,
                repeatedPasswordStatus : null,
                email : null,
                emailStatus : null,
                nameStatus : null,
                name : null,
                surnameStatus : null,
                surname : null,
                phoneStatus : null,
                phone : null,
                mailExists : false
            }
        },
        methods : {
            /** Password length */
            checkPassword : function(){
                if(!this.formData.password){
                    this.formData.passwordStatus = "Lozinka prekratka";
                    return false;
                } else if( this.formData.password.length < 8 ){
                    this.formData.passwordStatus = "Lozinka prekratka";
                    return false;
                } else {
                    this.formData.passwordStatus = null;
                    return true;
                }
            },
            checkPasswordMatch : function(){
                if(this.formData.password == this.formData.repeatedPassword){
                    this.formData.repeatedPasswordStatus = null;
                } else {
                    this.formData.repeatedPasswordStatus = "Lozinke se ne poklapaju!";
                    return false;
                }
            },
            checkEmail : function(){
                axios.get(baseUrl('register/check_email'), {
                    params : {
                        'reg_form_email' : this.formData.email
                    }
                }).then((response)=>{
                    if(response.data.status == 200){
                        this.formData.emailStatus = "E-pošta već postoji!";
                        vueApp.formData.mailExists = false;
                    } else if( response.data.status == 403 ){
                        this.formData.emailStatus = null;
                        vueApp.formData.mailExists = true;
                    }
                });
            },
            /** Submit Forms */
            checkForm : function(){
                this.regFormErrors = 0;
                // Check Name
                if(!this.formData.name){this.formData.nameStatus = "Upiši ime.."; this.regFormErrors++; }
                else{ this.formData.nameStatus = null; }

                // Check Surname
                if(!this.formData.surname){this.formData.surnameStatus = "Upiši prezime.."; this.regFormErrors++; }
                else{ this.formData.surnameStatus = null; }

                // Check Phone
                if(!this.formData.phone){this.formData.phoneStatus = "Upiši broj..."; this.regFormErrors++; }
                else { this.formData.phoneStatus = null; }

                // Check Email
                if(!this.formData.email){ this.formData.emailStatus = "Upisite e-mail"; this.regFormErrors++; }
                else{ this.formData.emailStatus = null; }

                // Check Password
                if(!this.formData.password){ this.formData.passwordStatus = "Upisite lozinku..."; this.regFormErrors++; }
                else{ this.formData.passwordStatus = null; }

                // Check Repeated PAsswors
                if(!this.formData.repeatedPassword){ this.formData.repeatedPasswordStatus = "Upisite novu lozinku..."; this.regFormErrors++; }
                else{ this.formData.repeatedPasswordStatus = null; }

                if(!this.formData.mailExists){ this.regFormExists++; }

                if(this.regFormErrors == 0){
                    this.readyToComplete = true;
                } else {
                    this.checkStatus = true;
                }

            },

            submitForm : function(){ this.$refs.regForm.submit(); }
        }
    });
</script>

<!-- Footer -->
<?php echo $footer; ?>