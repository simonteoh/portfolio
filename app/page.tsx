import Nav from '@/components/Nav';
import About from '@/components/About';
import Contact from '@/components/Contact';
import Project from '@/components/Project';
import Hero from '@/components/Hero';

export default function Home() {
 
  return (
    <main className=''>
      <Nav />
      <section className='pb-12 lg:px-0'>
        <Hero/>
        <About className="bg-[#ffffff] px-8 md:px-[250px] py-12"/>
        <Project className='bg-[#437fc7] px-8 py-12'/>
        <Contact className="bg-[#ffffff] px-8 md:px-[250px] py-12"/>
      </section>
    </main>
  );
}
