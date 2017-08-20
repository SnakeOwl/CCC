  public class Password:IComparable
    {
        private string Sait, Pass, Logi,Link;
        public Password(string sait,string pass,string logi, string link)
        {
            Sait = sait;
            Pass = pass;
            Logi = logi;
            Link = link;
        }
        public Password(string sait, string pass, string logi)
        {
            Sait = sait;
            Pass = pass;
            Logi = logi;
            Link = "www.google.com";
        }
        public string SAIT
        {
            get { return Sait; }
            set { Sait = value; }
        }
        public string PASS
        {
            get { return Pass; }
            set { Pass = value; }
        }
        public string LOGI
        {
            get { return Logi; }
            set { Logi = value; }
        }
        public string LINK
        {
            get { return Link; }
            set { Link = value; }
        }
        int IComparable.CompareTo(object obj)
        {
            Password met = (Password)obj;
            return String.Compare(this.Sait,met.Sait);
        }
    }
}
