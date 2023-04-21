<template>
    <footer>
        <div class="footer-container">
            <div class="logo">
                <img src='/assets/logo-white.png'/>
            </div>
            <div class="links">
                <ul>
                    <li v-for="(category, index) in footerLinks" :key="index">
                        <h1>{{ category.title }}</h1>
                        <ul>
                            <li v-for="(link, index) in category.links" :key="index">{{ link }}</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="links-container">
            <div class="social-links">
                <p> &#169; 2023 Reinis Alpiņš</p>
                <div class="socials-icons">
                    <ul>
                        <li v-for="(item, index) in socialIcons" :key="index">
                            <i :class="item.icon"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>
<script setup>
const footerLinks = [
    {
        title: 'Noderīgas saites',
        links: ['Par mums', 'Noteikumi', 'Sazināties'],
    },
    {
        title: 'Vakances',
        links: ['Darbs', 'Prakse', 'Pašnodarbinātajiem'],
    },
];

const socialIcons = [
    {icon: 'pi pi-facebook'},
    {icon: 'pi pi-twitter'},
    {icon: 'pi pi-instagram'},
];

</script>

<style lang="scss">
footer {
    display: flex;
    justify-content: center;
    flex-direction: column;
    width: 100%;
    background: #1c1c1c;
    align-items: center;

    .footer-container {
        display: flex;
        flex-wrap: wrap;
        max-width: 1600px;
        width: 100%;
        color: #fff;
        padding: 40px 50px;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        border-bottom: 1px solid white;

        //@media screen and (max-width: 450px) {
        //    padding: 40px 20px;
        //}

        @media screen and (max-width: 900px){
            padding: 40px 20px;
        }

        .logo {
            img {
                max-height: 70px;
                max-width: 280px;
                width: 100%;
            }
        }

        .links {
            h1 {
                margin-bottom: 20px;
            }

            ul {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                gap: 50px;
                justify-content: space-between;

                ul {
                    flex-direction: column;
                    gap: 10px;

                    .icon {
                        font-size: 20px;
                        text-align: left;
                    }
                }
            }
        }
    }

    .links-container {
        background: #1c1c1c;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 7px;
        padding-bottom: 7px;

        .social-links {
            display: flex;
            flex-direction: row;
            max-width: 1600px;
            width: 100%;
            padding: 15px 50px;
            justify-content: space-between;
            align-items: center;

            @media screen and (max-width: 900px){
                padding: 15px 20px;
            }
            @media screen and (max-width: 500px) {
                flex-direction: column;
                gap: 20px;

                p {
                    order: 2;
                }
            }

            p {
                font-size: 15px;
                color: white;
            }

            .socials-icons {
                ul {
                    display: flex;
                    color: white;
                    font-size: 20px;
                    gap: 10px;

                    li {
                        display: flex;
                    }
                }
            }
        }
    }
}
</style>
