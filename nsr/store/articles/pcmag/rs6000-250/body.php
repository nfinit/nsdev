    <h1 align="center">IBM's RISC System/6000 Puts The Pentium on Notice</h1>
    <p align="center"><i>by David Wilson, PC Magazine (<a
          href="https://books.google.com/books?id=VK6meblp0xsC&amp;pg=PA37" target="_blank">February
          8 1994, pages 37-38</a>)</i></p>
    <hr>
    <p>What costs $11,000, doesn't run Windows or DOS applications
      directly, yet needs to be understood by anyone considering
      high-end PC purchases in the next two years?</p>
    <p>The IBM RISC System/6000 Model 250, one of the first machines
      based on the jointly developed PowerPC chip, holds the honor of
      that price tag, and quite possibly should hold your attention,
      too. But why, with Pentium machines now available, should you care
      about somebody else's new, nonstandard CPU? For a number of
      reasons: performance, price, size, and the possible eventual
      support for a wide variety of operating systems.</p>
    <img src="img/pcmag-8294-25t.GIF" title="RS/6000 Model 250" alt="Big
      power with an $11,000 price tag" width="265" height="298"
      align="right">
    <p>The POWERstation 25T is the high-end model in IBM's RS/6000 Model
      250 system series. What differentiates the Model 250 series from
      other RS/6000 models is the use of the new PowerPC 601 (PPC601)
      RISC (reduced instruction set computer) processor jointly
      developed by Motorola, IBM, and Apple.</p>
    <p>The PPC601 is the first of many microprocessor implementations
      planned for the PowerPC family of RISC chips.</p>
    <p>Derived from the single-chip version of IBM's POWER (Performance
      Optimization With Enhanced RISC) architecture called the RSC (RIOS
      Single-Chip), and using bus interface components from Motorola's
      88110 RISC processor, the PPC601 is a high-performance 32-bit RISC
      processor. Systems in the RS/6000 Model 250 series run AIX, IBM's
      version of Unix; they have substantial expansion capability and
      low prices (for Unix machines), and are extremely fast for
      entry-level workstations.</p>
    <p>IBM has been researching systems based on RISC processors for
      years. RISC chips run faster than most traditional microprocessors
      because of the comparatively simple instruction sets they use. A
      program compiled to run on a RISC system is likely to be larger
      (with more but simpler instructions) than the same program on a
      CISC (complex instruction set computer) system, such as any PC
      powered by the Intel 80x86 processor family. But the RISC
      processor will run the program faster than the CISC.</p>
    <p>With its native PPC601 RISC processor, the RS/6000 Model 250 can
      run DOS or Windows apps through emulation or translation software.
      THe AIX operating system will optionally include Windows support
      using WABI (Windows Application Binary Interface) technology
      developed by SunSelect and IBM (the emulator was unavailable for
      testing at press time). Emulated DOS performance on any of the
      RS/6000 Model 250s is expected to approach 25-MHz 486 performance
      for emulated applications.</p>
    <h2>First Foray</h2>
    <p>The RS/6000 Model 250 system class has a basic list price of
      $4,795, but in the workstation world, that means "starting point,"
      not "low-end system price." The basic configuration machine has
      16MB of RAM and a standard set of interfaces (two serial, plus
      parallel, SCSI, and Ethernet), but no software, disk drives,
      keyboard, mouse, or video board/monitor.</p>
    <p>IBM offers three configured packages based on the RS/6000 250.
      The POWERserver 25S, $8,495, is a server and, in the low-end
      configuration, has a 1GB disk and eight serial ports. The
      POWERstation 25W, $7,595, has a 540MB hard disk, a mouse, and a
      1,024-by-768 video board. The POWERstation 25T, $9,395, comes with
      a high-performance 1,280-by-1,024 video board an 17-inch monitor,
      540MB SCSI hard disk, and mouse.</p>
    <img src="img/pcmag-8294-ppc601.GIF" title="PowerPC 601 CPU"
      alt="The PPC601 CPU sits under a large heat sink." width="255"
      height="373" align="left">
    <h2>$11,000 Worth of Power</h2>
    <p>The system we looked at, a POWERstation 25T configuration,
      included a 1GB hard disk, 32MB of RAM, and a floppy disk drive.
      This raised the price to $11,268. AIX Unix software needs to be
      licensed, and we also needed the optional F<i>o</i>rtran compiler.
      Together, the two cost an additional $1,873.</p>
    <p>From the outside, the POWERstation 25T looks a lot like a PC. The
      box is a small desktop machine, 3 by 16 by 16.5 inches (HWD). The
      keyboard and mouse could belong to a PC as well. Inside, there are
      eight SIMM sockets, for PS/2-style SIMMs. System RAM totals from
      16MB to 256MB are possible. Supplementing the standard interfaces
      are two Micro Channel slots for expansion. The machine has one bay
      for a 3.5-inch floppy disk drive and one for a 3.5-inch SCSI hard
      disk (sizes from 540MB to 2GB are supplied by IBM). Additional
      peripherals and disk expansion are supported through the external
      SCSI interface. One additional slot in the system is a "PowerPC
      local processor bus slot" designed for IBM's high-performance IBM
      GXT-150 graphics adapter.</p>
    <h2>One System Choice</h2>
    <p>The RS/6000 Model 250 series was developed by IBM's Advanced
      Workstation and Systems Group (AWS) and the first to use the
      PPC601 chip. At the same time, IBM's newly announced Power
      Personal Systems Division will focus development efforts on
      desktop, server, and portable systems based on the PowerPC
      architecture. PowerPC-based personal computers will run both
      native ports and emulated versions of several PC operating
      systems. Apple, for example, will use the PPC601 in a forthcoming
      series of Macintosh products, running a native version of Apple's
      System 7 operating system.</p>
    <p>Currently, only AIX Unix is available as an operating system for
      the system we tested. The long-term plan is to create an
      underlying kernel (based on the Mach operating system), and on top
      of that add services to support Unix (IBM's AIX and Sun's
      Solaris), Windows NT, OS/2, and the object-oriented Taligent
      operating system (from an Apple/IBM development project), all in
      native modes. Additionally, there are plans to support DOS,
      Windows, and Macintosh applications using compatibility and
      emulation techniques. Note that these operating system plans are
      for the PPC601 chip and some future machines based upon it. We
      have no indication of when or if the POWERstation 25T we looked at
      will be able to support all of the planned operating systems.</p>
    <p>Essentially, the promising RS/6000 Model 250 series suffers from
      the chicken-and-egg problem: Will a native application become so
      popular that people will buy one of these systems simply in order
      to run it? Or will the RS/6000 Model 250's price and performance
      attract sufficient numbers of workstation customers for system and
      application developers to rewrite code so that their products can
      run, in native form, on the new platform?</p>
    <p>List price:<i> IBM RISC System/6000 POWERstation 25T, with
        17-inch monitor, 540MB SCSI hard disk, mouse, AIX/6000 2-user
        license, and AIX windows Environment/6000, <b>$9,395</b>.<br>
      </i></p>
    <hr width="100%" size="2">
    <h2>Power past the Pentium?</h2>
    <p>No doubt about it, the IBM RISC System/6000 POWERstation 25t is a
      fast system. In the Unix world, a performance is often measured by
      the SPEC tests, with separate tests for integer and floating-point
      performance. IBM rates its system at 62.6 integer SPECmarks and
      72.2 floating-point SPECmarks. We verified these performance
      levels in our testing.</p>
    <p>The SPECmark results for the POWERstation 25T are similar to
      those claimed by the 66-MHz Pentium chip, but in our informal
      testing we found that with the Pentium, most compilers generate
      performance levels much lower than their optimum. While simple IBM
      optimization gives 75% of the expected SPECmark performance, we
      typically saw only about 40 percent of the claimed SPECmark
      performance on a Pentium, which was due to the less-than-optimal
      compilers often used for Intel machines. This tends to give IBM a
      major performance advantage (up to 100 percent) when comparing two
      similar programs on the POWERstation 25T and on a Pentium-based
      system. Typically, we saw a 300 percent or better advantage for
      the IBM machine over the fastest 486-based systems.</p>
    <p>Many floating-point-intensive tests run twice as fast on the
      POWERstation as they do on a Pentium machine; floating point is a
      strength of the RS/6000 line.</p>
    <p>Overall, we found IBM's POWERstation 25T the fastest machine
      we've tested in the $10,000 price vicinity. <i>-DW</i><br>
    </p>
