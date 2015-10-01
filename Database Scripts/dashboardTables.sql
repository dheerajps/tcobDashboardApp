-- TABLE STRUCTURES

-- Creates dashboard_groups
-- group_id		group_name
-- 
-- acc			ACCOUNTANCY
-- adm			ADMINSTRATOR
-- adv			ADVISING
-- bus			BUSINESS CAREER SERVICES
-- cros			CROBY MBA
-- dev			DEVELOPMENT
-- exec			EXECUTIVE COMMITTE
-- execMBA		EXEC MBA
-- fin			FINANCE
-- grad			GRADUATE PROGAMS
-- mgmt			MANAGEMENT
-- phd			PHD
-- ugp			UG PROG				
CREATE TABLE dbo.dashboard_groups(
	group_id VARCHAR(30) PRIMARY KEY,
	group_name VARCHAR(50) NOT NULL
);

-- Creates dashboard topics
-- topic_id		topic_name
-- BUS			Business Things
-- IMP			Impact Measures
-- OTH			Other Things
-- STR			Strategic Initiatives
CREATE TABLE dbo.dashboard_topics(
	topic_id VARCHAR(30) PRIMARY KEY,
	topic_name VARCHAR(50) NOT NULL
);

-- Creates dashboard sections table
-- 	section_id	section_name
--	SEC1		Section 1
--	SEC2		Section 2
--	SEC3		Section 3
CREATE TABLE dbo.dashboard_sections(
	section_id VARCHAR(30) PRIMARY KEY,
	section_name VARCHAR(50) NOT NULL
);

-- Creates URL table
--bingDashboard		BING	http://www.bing.com/
--fbDashboard		FACEBOOK	https://www.facebook.com/
--googleDashboard	GOOGLE 	https://www.google.com/
--mizzouDashboard	MIZZOU	http://missouri.edu/
--twDashboard		TWITTER	https://twitter.com/
CREATE TABLE dbo.dashboard_urls(
	url_id VARCHAR(30) PRIMARY KEY,
	url_name VARCHAR(50) NOT NULL,
	url_address VARCHAR(MAX) NOT NULL
);

CREATE TABLE dbo.dashboard_sections_by_topics(
	section_id VARCHAR(30) REFERENCES dbo.dashboard_sections,
	topic_id VARCHAR(30) REFERENCES dbo.dashboard_topics
);

CREATE TABLE dbo.dashboard_url_by_section(
	url_id VARCHAR(30) REFERENCES dbo.dashboard_urls,
	section_id VARCHAR(30) REFERENCES dbo.dashboard_sections
);

CREATE TABLE dbo.dashboard_topics_by_group(
	topic_id VARCHAR(30) REFERENCES dbo.dashboard_topics,
	group_id VARCHAR(30) REFERENCES dbo.dashboard_groups
);


