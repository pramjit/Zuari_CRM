using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;
using System.Security.Cryptography;
using System.Data.Odbc;
using System.Data;
using System.Configuration;
using System.Net;
using System.Text; 
using System.IO;
/// <summary>
/// Summary description for tclcrmivrinsertdata
/// </summary>
[WebService(Namespace = "http://aksha/app/")]
[WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]

public class tclcrmivrinsertdata : System.Web.Services.WebService {
   // string connection = "";
    private string tclcrmivrinsertdata1()
    {
        string val = "";

        val = ("Driver={MySQL ODBC 5.1 Driver};Server=localhost;Database=zuaricrm;User=zuari;Password=zuaricrm");
       // val = ("Driver={MYSQL ODBC 3.51 Driver}; Server=192.168.1.123; Database=tatacomplain; User=root; Password=123456");
        return val;


    }

    [WebMethod]
    public string IVRdata(string mobile)
    {
      
	  string date=DateTime.Now.ToString("yyyy-MM-dd");
	  string time=DateTime.Now.ToString("HH:mm:ss");
	  string languagesel="1";
	  string key="1";
	  string userid="akshamaala";
	  string password="akshamaala";
   mobile=  mobile.Substring(mobile.Length - 10);

        string check = "";
        string farmerid = "0";
        int count = 0;
      
        string user_id="";
        LogWriter log = LogWriter.Instance;
        OdbcConnection connection = new OdbcConnection(tclcrmivrinsertdata1());
        try
        {
string querytrans = "INSERT INTO mas_incomingcall_trans (MOBILE, DATE_RECEIVED, TIME_RECEIVED,LANGUAGESEL,KEYPRESS,USERID,PASSWORD)  VALUES ('" + mobile + "','" + date + "','" + time + "','" + languagesel + "','" + key + "','" + userid + "','" +password+"') ";
                connection.Open();
                OdbcCommand insertivrrecoordtrans = new OdbcCommand(querytrans, connection);
                insertivrrecoordtrans.ExecuteNonQuery();

             
                connection.Close();
            if(userid=="akshamaala" && password =="akshamaala" && (key=="2" || key =="1")){
            farmerid = Get10Digits();
            string mobilelasttendisit = mobile.Substring(mobile.Length - 10);
            string fourdisitmobile = mobilelasttendisit.Substring(0, 4);
            string stateid = "728";
            string sqlst = "SELECT stateid FROM ms_mobilestate where mobilecode='" + fourdisitmobile + "'";
            log.WriteToLog(sqlst);
            OdbcCommand cmd = new OdbcCommand(sqlst, connection);
            OdbcDataAdapter dast = new OdbcDataAdapter(cmd);
            DataTable dtst = new DataTable();
            dast.Fill(dtst);

                if (dtst.Rows.Count > 0)
                {
                      log.WriteToLog("in---"+stateid);
                    stateid = dtst.Rows[0][0].ToString();
                }
                      log.WriteToLog(stateid);  

            string sqltcl = "SELECT FAR_ID FROM mas_farmer where FAR_MOBILE='" + mobile + "'";

            OdbcCommand cmdtcl = new OdbcCommand(sqltcl, connection);
            OdbcDataAdapter dattcl = new OdbcDataAdapter(cmdtcl);
            DataTable dttclcrm= new DataTable();
            dattcl.Fill(dttclcrm);
            if (dttclcrm.Rows.Count > 0)
            {
                user_id = dttclcrm.Rows[0][0].ToString();
            }
            else
            {
                string sqltks = "SELECT Tks_id FROM mas_tks_dtl where TKS_MOBILE='" + mobile + "'";

                OdbcCommand cmdtks = new OdbcCommand(sqltks, connection);
                OdbcDataAdapter dattks = new OdbcDataAdapter(cmdtks);
                DataTable dtttks = new DataTable();
                dattks.Fill(dtttks);
                if (dtttks.Rows.Count > 0)
                {
                    user_id = dtttks.Rows[0][0].ToString();
                }
                else
                {
                    string querytclfarm = "INSERT INTO mas_farmer (FAR_ID, FAR_MOBILE, CR_DATE, STATE_ID)  VALUES ('" + farmerid + "','" + mobile + "','" + DateTime.Now.ToString("yyyy-MM-dd") + "','" + stateid + "') ";
                    connection.Open();
                    OdbcCommand inserttskpmrecoord = new OdbcCommand(querytclfarm, connection);
                    check = Convert.ToString(inserttskpmrecoord.ExecuteNonQuery());
                    // Logger.Info(querytkpm);
                    connection.Close();
                    user_id = farmerid;

                }

            }
           

            string sql = "SELECT USERID,NOTIMESRECEIVED FROM cc_incomingcall where MOBILE='" + mobile + "' and status='18'";

            OdbcCommand cmmd = new OdbcCommand(sql, connection);
            OdbcDataAdapter da = new OdbcDataAdapter(cmmd);
            DataTable dt = new DataTable();
            da.Fill(dt);
            if (dt.Rows.Count > 0)
            {
                string farmer = dt.Rows[0][0].ToString();
                count = Convert.ToInt16(dt.Rows[0][1].ToString());
                count = count + 1;

                string query = "update cc_incomingcall set NOTIMESRECEIVED= '" + count + "',DATE_RECEIVED='" + DateTime.Now.ToString("yyyy-MM-dd") + "',TIME_RECEIVED='" + DateTime.Now.ToString("HH:mm:ss") + "' where userid='" + user_id + "' and mobile='" + mobile + "' and status='18' ";
                connection.Open();
                OdbcCommand insertivrrecoord = new OdbcCommand(query, connection);
                check = Convert.ToString(insertivrrecoord.ExecuteNonQuery());
              
                connection.Close();
              

            }

            else
            {

                string query = "INSERT INTO cc_incomingcall (userid, MOBILE, DATE_RECEIVED, TIME_RECEIVED, STATUS, STATE,NOTIMESRECEIVED,LANGUAGE)  VALUES ('" + user_id + "','" + mobile + "','" + DateTime.Now.ToString("yyyy-MM-dd") + "','" + DateTime.Now.ToString("HH:mm:ss") + "','" + "18" + "','" + stateid + "','1','"+languagesel+"') ";
                connection.Open();
                OdbcCommand insertivrrecoord = new OdbcCommand(query, connection);
                check = Convert.ToString(insertivrrecoord.ExecuteNonQuery());
             
                connection.Close();
            


            }
            //send sms
			ivrsms(mobile);
			
        }
else{
check="2";
}
        }
        catch (Exception ex)
        {
            log.WriteToLog(ex.Message + "---" + ex.StackTrace);
            check = ex.Message;
            check = "0";
        }
        return check;
    }

    private string Get10Digits()
    {
        byte[] bytes = new byte[8];

        RandomNumberGenerator rng = RandomNumberGenerator.Create();
        rng.GetBytes(bytes);
        ulong random = BitConverter.ToUInt64(bytes, 0) % 10000000000;
        return String.Format("{0:D10}", random);
    }
	
public  string ConvertStringToHex(string asciiString)
        {
            string hex = "";
           
           foreach (char c in asciiString)
          
            {
                int tmp = c;
                hex += String.Format("{0:x4}", (uint)System.Convert.ToUInt64(tmp.ToString()));
            }
            return hex;
        }


private void ivrsms(string mobilenumber)
    {
		LogWriter log = LogWriter.Instance;
	        if (mobilenumber.Length == 13)
        {
            mobilenumber = mobilenumber.Substring(3, 10);

        }
        else if (mobilenumber.Length == 12)
        {
            mobilenumber = mobilenumber.Substring(2, 10);

        }
        else
        {
            mobilenumber = mobilenumber.Substring(0, 10);
        }
//
	log.WriteToLog("sms");
	string st="";   
	st = ConvertStringToHex("Adventz मध्ये स्वारस्य दाखविल्याबद्दल धन्यवाद, आमचे प्रतिनिधी आपणास थोड्याच वेळात फोन करतील");
	string url="http://www.smscountry.com/SMSCwebservice.asp?User=Akshamaala10&passwd=akshamaala10&sid=JAIKSN&DR=Y&mobilenumber=91" + mobilenumber + "&message=" + st + "&Mtype=OL";
    HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);	 
          // execute the request
    HttpWebResponse response = (HttpWebResponse)request.GetResponse();
          StreamReader sr = new StreamReader(response.GetResponseStream(), System.Text.Encoding.ASCII);
         //Convert the stream to a string
          string s = sr.ReadToEnd();
		   log.WriteToLog("sms-"+s+"-"+url);
          sr.Close();
          response.Close();                 
	}
    
}
