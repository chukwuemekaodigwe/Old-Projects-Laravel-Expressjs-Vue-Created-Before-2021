var config = {
        container: "#OrganiseChart1",
        rootOrientation: 'NORTH', // NORTH || EAST || WEST || SOUTH
        scrollbar: "fancy",
        //levelSeparation: 30,
        siblingSeparation: 20,
        subTeeSeparation: 60,

        nodeAlign: "BOTTOM",
        animateOnInit: true,

        connecors: {
            type: 'step'
        },
        node: {
            HTMLclass: 'nodeExample1',
            collapsable: true
        },
        animation: {
            nodeAnimation: "easeOutBounce",
            nodeSpeed: 700,
            connectorsAnimation: "bounce",
            connectorsSpeed: 700
        }

    },
    ceo = {
        text: {
            name: "Mark Hill",
            title: "Chief executive officer",
            contact: "Tel: 01 213 123 134",
        },
        img: "../headshots/2.jpg",
        HTMLid: "ceo",

    },

    cto = {
        parent: ceo,
        text: {
            name: "Joe Linux",
            title: "Chief Technology Officer",
        },
        stackChildren: true,
        img: "../headshots/1.jpg",
        HTMLid: "coo"
    },
    cbo = {
        parent: ceo,
        stackChildren: true,
        text: {
            name: "Linda May",
            title: "Chief Business Officer",
        },
        img: "../headshots/5.jpg",
        HTMLid: "cbo"
    },
    cdo = {

        parent: ceo,
        text: {
            name: "John Green",
            title: "Chief accounting officer",
            contact: "Tel: 01 213 123 134",
        },
        img: "../headshots/6.jpg",
        HTMLid: "cdo"
    },


    cio = {
        parent: cto,
        text: {
            name: "Ron Blomquist",
            title: "Chief Information Security Officer"
        },
        img: "../headshots/8.jpg",
        HTMLid: "cio"
    },
    ciso = {
        parent: cto,
        text: {
            name: "Michael Rubin",
            title: "Chief Innovation Officer",
            contact: "we@aregreat.com"
        },
        img: "../headshots/9.jpg",
        HTMLid: "ciso"
    },
    cio2 = {
        parent: cdo,
        text: {
            name: "Erica Reel",
            title: "Chief Customer Officer"
        },
        link: {
            href: "www.google.com"
        },
        img: "../headshots/10.jpg",
        HTMLid: "cio2"
    },
    ciso2 = {
        parent: cbo,
        text: {
            name: "Alice Lopez",
            title: "Chief Communications Officer"
        },
        img: "../headshots/7.jpg",
        HTMLid: "ciso2"
    },
    ciso3 = {
        parent: cbo,
        text: {
            name: "Mary Johnson",
            title: "Chief Brand Officer"
        },
        img: "../headshots/4.jpg",
        HTMLid: "ciso2"
    },
    ciso4 = {
        parent: cbo,
        text: {
            name: "Kirk Douglas",
            title: "Chief Business Development Officer"
        },
        img: "../headshots/11.jpg",
        HTMLid: "ciso2"
    }

ALTERNATIVE = [
    config,
    ceo,
    cto,
    cbo,
    cdo,
    cio,
    ciso,
    cio2,
    ciso2,
    ciso3,
    ciso4
];