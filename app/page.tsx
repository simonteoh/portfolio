"use client"
import Image from 'next/image';
import { TypeAnimation } from 'react-type-animation';
import skills from '@/data/skills.json'
import projects from '@/data/projects.json'
import Nav from '@/components/Nav';
import linkedinIcon from '@/public/icons/linkedin-icon.svg'
import mailIcon from '@/public/icons/mail-icon.svg'

export default function Home() {

  return (
    <main className='bg-white dark:bg-slate-800'>
      <Nav />
      <section className='px-4 py-12 lg:px-0'>
        <div className='md:mt-0 lg:px-12 flex flex-col md:flex-row items-center md:justify-between md:h-screen'>
          <div className='sm:text-center lg:text-left'>
            <h1 className='text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white md:text-6xl'>Hi I&apos;m Simon 👋</h1>
            <TypeAnimation
              className='text-blue-500 md:text-5xl'
              sequence={[
                'Web Developer',
                1500,
                'Frontend Developer',
                1500,
                'Software Developer',
              ]}
              wrapper="span"
              speed={15}
              style={{ display: 'inline-block', height: '1rem', fontWeight: '900' }}
              repeat={Infinity}
            />
          </div>
          <Image src={"/web_dev_image.svg"} alt='web development' className="w-[500px] h-[500px]" width={0} height={0} priority />
        </div>
        <div id='about' className='lg:px-12'>
          <h1 className='text-black dark:text-white text-4xl md:text-6xl font-extrabold text-center'>About Me</h1>
          <p className='text-blue-500 text-xl md:text-3xl font-extrabold mt-12'>A little bit of me</p>

          <div className='text-base md:text-2xl'>
            <p className='mt-12 text-xl md:text-justify text-gray-500 dark:text-gray-300'>I am a <strong>Web Developer</strong> who focus on <strong>Frontend</strong> of course for knowledge to build full-stack web application is doable as well. As a web developer, I am dedicated to crafting seamless digital experiences that captivate and engage users. My expertise lies in frontend development, where I leverage the latest technologies and best practices to ensure optimal performance and usability across various devices and platforms. From conceptualization to deployment, I am committed to delivering high-quality solutions that not only meet but exceed client expectations. With a relentless pursuit of innovation and a drive for excellence, I am constantly observing industry trends to stay at the forefront of web development.<br /><br />

              For me as a web developer, especially in frontend development, it is important to ensure a great user experience. For example, the web application should be responsive to any device, and it should load as fast as possible. Meanwhile, for the product owner, a user-friendly product will attract more leads to the website, potentially converting them into customers.</p>
          </div>
          <div>
            <p className='text-blue-500 text-xl md:text-3xl font-extrabold mt-12'>Technologies and tools</p>
            <div className='flex flex-wrap mt-8 justify-between'>
              {skills.map((skill, index) => {
                return (
                  <div key={index} className='py-2 px-4 bg-gray-50 md:m-4 mx-2 mt-6 rounded-lg flex items-center hover:scale-125 cursor-pointer md:w-48 w-40'>
                    <Image src={skill.icon} alt={skill.name} className="w-[48px] h-[48px]" width={0} height={0} loading='lazy' />
                    <h4 className='text-md ml-4'>{skill.name}</h4>
                  </div>
                )
              }
              )}
            </div>
          </div>
        </div>
        <div id='projects' className='lg:px-12'>
          <h1 className='text-black dark:text-white text-4xl md:text-6xl font-extrabold text-center my-12'>Projects</h1>
          <div className='flex flex-wrap gap-24 md:p-24'>
            {projects.map((project, index) => {
              return (
                <div key={index} className="max-w-lg bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                  <Image src={project.image} alt={project.name} className='w-full h-auto' width={500} height={500} />
                  <div className="p-5">
                    <a href="#">
                      <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {project.name}
                      </h5>
                    </a>
                    <p className="mb-3 font-normal text-gray-700 dark:text-gray-400">
                      {project.desc}
                    </p>
                  </div>
                </div>
              )
            })}
          </div>
        </div>
        <div id='contact' className='lg:px-12'>
          <h1 className='text-black dark:text-white text-4xl md:text-6xl font-extrabold text-center my-12'>Contact</h1>
          <div className='flex flex-wrap gap-24 md:p-24'>
            <div><h4 className="text-3xl font-semibold text-blue-500">Connect with me</h4><p className="text-gray-500 text-xl">If you want to know more about me or my work, or if you would just<br />like to say hello, send me a message. I&apos;d love to hear from you.</p></div>
          </div>
          <div className='flex flex-col gap-4 text-xl text-black dark:text-white mt-12 '>
            <div className='flex gap-4'>
              <Image src={mailIcon} alt='email' width={30} height={30} />
              <p>simonteoh1996@gmail.com</p>
            </div>
            <div className='flex gap-4'>
              <Image src={linkedinIcon} alt='Linkedin' width={30} height={30} />
              <p>https://www.linkedin.com/in/simon-teoh-chun-seong-b615751b1/</p>
            </div>
          </div>
        </div>
      </section>
    </main>
  );
}
